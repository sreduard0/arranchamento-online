<?php

namespace App\Http\Controllers;

use App\ArranchamentoModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // Início
    public function home(){
         if(session('Arranchamento')['profileType'] == 1){
            return view('homeadmin');
        }else{
            return view('home');
        }
    }

    //EDITAR ARRANCHAMENTO
    public function get_edit_arranchamento($id){
        return ArranchamentoModel::where('user_id', session('user')['id'])->where('id', $id)->first();
    }

    //EXCLUIR ARRANCHAMENTO
    public function get_delete_arranchamento($id){
        ArranchamentoModel::where('user_id', session('user')['id'])->where('id', $id)->first()->delete();
    }

    //BUSCANDO COGITATIVO DAS CIAS
    public function get_cogitative_day(){
        $em = count(ArranchamentoModel::where('company_id', 1)->where('date',date('Y-m-d'))->get());
        $ccsv = count(ArranchamentoModel::where('company_id', 2)->where('date',date('Y-m-d'))->get());
        $cia1 = count(ArranchamentoModel::where('company_id', 3)->where('date',date('Y-m-d'))->get());
        $cia2 = count(ArranchamentoModel::where('company_id', 4)->where('date',date('Y-m-d'))->get());
        $cia3 = count(ArranchamentoModel::where('company_id', 5)->where('date',date('Y-m-d'))->get());

        $data = [
            'em' => $em,
            'ccsv' => $ccsv,
            'cia1' => $cia1,
            'cia2' => $cia2,
            'cia3' => $cia3,
        ];
        return $data;
    }











    // POSTs //
    //NOVO ARRANCHAMENTO
    public function new_arranchamento(Request $request)
    {
        $data = $request->all();

        $checkarrachamento = ArranchamentoModel::where('date', date('Y-m-d', strtotime($data['date'])))->first();

        if($checkarrachamento)
        {
            return 'error';

        }else{

            $new_arranchamento = new ArranchamentoModel();
            $new_arranchamento->user_id = session('user')['id'];
            $new_arranchamento->company_id = session('user')['company']['id'];
            $new_arranchamento->date = date('Y-m-d', strtotime($data['date']));
            $new_arranchamento->brekker = $data['brekker'];
            $new_arranchamento->lunch = $data['lunch'];
            $new_arranchamento->dinner = $data['dinner'];
            $new_arranchamento->status = 1;
            $new_arranchamento->save();
        }


    }
    //EDITAR ARRANCHAMENTO
    public function edit_arranchamento(Request $request)
    {
        $data = $request->all();

        $editarrachamento = ArranchamentoModel::find($data['id']);

        if($editarrachamento->user_id != session('user')['id'])
        {
            return 'error';

        }else{
            $editarrachamento->brekker = $data['brekker'];
            $editarrachamento->lunch = $data['lunch'];
            $editarrachamento->dinner = $data['dinner'];
            $editarrachamento->save();
        }


    }

    //DATATABLES ARRANCHAMENTOS
    public function get_arranchamentos(Request $request)
    {
    //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'date',
            1 =>'brekker',
            2 => 'lunch',
            3=> 'dinner',
            4=> 'id'
        );

            $arranchamentos = ArranchamentoModel::where('user_id', session('user')['id'])->where('date','>=', date('Y-m-d'))->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($arranchamentos);
            $rows= count($arranchamentos);



        // Ler e criar o array de dados
        $dados = array();
        foreach ($arranchamentos as $arranchamento){
            $dado = array();
            if($arranchamento->date == date('Y-m-d')){
                    $dado[] = '<strong>Está arranchado hoje<strong/>';
            }else{
                    $dado[] = "<strong>".date('d-m-Y', strtotime($arranchamento->date))."<strong/>";
            }
            if($arranchamento->brekker == 1){
                    $dado[] = 'sim';
            }else{
                    $dado[] = 'Não';
            }
            if($arranchamento->lunch == 1){
                    $dado[] = 'sim';
            }else{
                    $dado[] = 'Não';
            }
            if($arranchamento->dinner == 1){
                    $dado[] = 'sim';
            }else{
                    $dado[] = 'Não';
            }
            if($arranchamento->date == date('Y-m-d')){
                    $dado[] = "
                    <button class='btn btn-primary' disabled ><i class='fa fa-pen '></i></button>
                    <button class='btn btn-danger' disabled ><i class='fa fa-trash'></i></button>
                    ";
            }else{
                   $dado[] = "
                    <button class='btn btn-primary'  data-toggle='modal' data-target='#editarranchamento' data-id='".$arranchamento->id."'><i class='fa fa-pen '></i></button>
                    <button class='btn btn-danger'  onclick='return delete_arranchamento(".$arranchamento->id.") '><i class='fa fa-trash'></i></button>
            ";
            }
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
