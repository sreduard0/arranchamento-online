<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;
use App\Classes\Tools;
use App\Models\DestinationModel;

class RecordsController extends Controller
{
    private $Tools;
    public function __construct()
    {
        $this->Tools = new Tools();
    }
    //===========================[View]============================
    function records()
    {
        $data = [
            'visitors' => VisitorsModel::all(),
            'destinations' => DestinationModel::all(),
        ];
        return view('home',$data);
    }

    //=============================={  Register Visitor }================================//
    public function record_visitor(Request $request)
    {
        $data = $request->all();

        $records = RecordsModel::where('visitor_id', $data['visitor_id'])->where('status', 1)->first();
        $visitor = VisitorsModel::find($data['visitor_id']);

        if(!empty($records) || $data['drive'] > $visitor->cnh)
        {
            return 'error';
        }else{
            $record = new RecordsModel();

            $record->visitor_id = $data['visitor_id'];
            $record->drive = $data['drive'];
            $record->destination_id = $data['destination_id'];
            $record->reason = $data['reason'];
            $record->badge = $data['badge'];
            $record->enterprise_id = $visitor->enterprise_id;
            $record->date_entrance = date('Y-m-d H:i:s');
            $record->registred_by = session('user')['rank']." ".session('user')['professionalName'];
            $record->status = 1;
            $record->save();

            if(!empty($data['phone'])){
                $visitor->phone = str_replace(['(',')', '-',' '], '', $data['phone']);
                $visitor->save();
            }

        }
    }
    //============================{  AÇÕES DOS REGISTROS }===============================//
    public function record_finish($id)
    {
        $record = RecordsModel::find($id);
        $record->date_exit = date('Y-m-d H:i:s');
        $record->finished_by = session('user')['rank']." ".session('user')['professionalName'];
        $record->status = 0;
        $record->save();
    }

    //============================{  FINALIZAE EXPEDIENTE }===============================//
    public function finish_all()
    {
        $records = RecordsModel::where('status', 1)->get();

        foreach ($records as $record){

            $record->date_exit = date('Y-m-d H:i:s');
            $record->finished_by = session('user')['rank']." ".session('user')['professionalName'];
            $record->status = 2;
            $record->save();

        }

    }

    //================================={ DataTables }====================================//
    public function get_records(Request $request)
    {
        //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'id',
            1 =>'visitor_id',
            2 => 'destination',
            3 => 'reason',
            4=> 'badge',
            5=> 'reason',
            6=> 'registred_by',
            7=>'date_entrance',
            8=>'drive',
        );

       //Obtendo registros de número total sem qualquer pesquisa
       $rows = count(RecordsModel::where('status', 1)->get());

            $records = RecordsModel::where('status', 1)->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset($requestData['start'])
                ->take($requestData['length'])
                ->get();
            $filtered = count($records);

        // Ler e criar o array de dados
        $dados = array();
        foreach ($records as $record){
            $drive = "";
            if($record->drive == 1){
                $drive = "<i  class='m-r-15 fas fa-steering-wheel'></i>";
            }

            $dado = array();
            $dado[] = "<img class='img-circle img-size-35' src='".$record->visitor->photo."'>";
            $dado[] = strtoupper($drive.$record->visitor->name);
            $dado[] = strtoupper($record->visitor->enterprise->name);
            $dado[] = "<i style='color:".$record->destination->color."' class='m-r-15 fas fa-circle'></i>".$record->destination->destination;
            $dado[] = $record->reason;
            $dado[] = $record->badge;
            $dado[] = $record->registred_by;
            $dado[] =  date('d/m/Y  H:m', strtotime($record->date_entrance));
            $dado[] = "
                <button class='btn btn-primary' title='Ver perfil do visitante'  data-toggle='modal' data-target='#visitor_profile'
                         data-id='".$record->visitor->id."'><i class='fa fa-user'></i></button>
                <button class='btn btn-success' title='Encerrar entrada' onclick='return confirm_exit(".$record->id.")'><i class='fa fa-check'></i></button>
            ";
            $dados[] = $dado;
        }


        //Cria o array de informações a serem retornadas para o Javascript
        $json_data = array(
            "draw" => intval($requestData['draw']),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval( $filtered ),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval($rows ), //Total de registros quando houver pesquisa
            "data" => $dados   //Array de dados completo dos dados retornados da tabela
        );

        return json_encode($json_data);  //enviar dados como formato json
    }


}
