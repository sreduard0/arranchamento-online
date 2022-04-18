<?php

namespace App\Http\Controllers;

use App\ArranchamentoModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // Início
    public function home(){
        return view('home');
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
            $new_arranchamento->date = date('Y-m-d', strtotime($data['date']));
            $new_arranchamento->brekker = $data['brekker'];
            $new_arranchamento->lunch = $data['lunch'];
            $new_arranchamento->dinner = $data['dinner'];
            $new_arranchamento->save();
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

       //Obtendo registros de número total sem qualquer pesquisa
       $rows = count(ArranchamentoModel::all());



            $arranchamentos = ArranchamentoModel::where('user_id', session('user')['id'])->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($arranchamentos);



        // Ler e criar o array de dados
        $dados = array();
        foreach ($arranchamentos as $arranchamento){
            $dado = array();
            if($arranchamento->date == date('Y-m-d')){
                    $dado[] = 'Está arranchado hoje';
            }else{
                    $dado[] = date('d-m-Y', strtotime($arranchamento->date));
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
            $dado[] = "
            <button class='btn btn-primary'  data-toggle='modal' data-target='#arranchamento_edit' data-id=''><i class='fa fa-pen '></i></button>
            <button class='btn btn-danger'  onclick='return confirm_delete()'><i class='fa fa-trash'></i></button>
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
