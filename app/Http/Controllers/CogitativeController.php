<?php

namespace App\Http\Controllers;

use App\ArranchamentoModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CogitativeController extends Controller
{
    public function cogitative_company($company){

        $data = [
            'company'=> $company
        ];
        session()->put('company_id', $company);
        return view('cogitative', $data);
    }

    public function get_company_cogitative(Request $request)
    {
        //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'user_id',
            1 =>'brekker',
            2 => 'lunch',
            3=> 'dinner',
            4=> 'id'
        );

            $cogitatives = ArranchamentoModel::where('company_id', session('company_id'))->where('date', date('Y-m-d'))->with('military')->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($cogitatives);
            $rows= count($cogitatives);



        // Ler e criar o array de dados
        $dados = array();
        foreach ($cogitatives as $cogitative){
            $dado = array();

                $dado[] = $cogitative->military->professionalName;
                if($cogitative->brekker == 1){
                    $dado[] = 'sim';
                }else{
                        $dado[] = 'Não';
                }
                if($cogitative->lunch == 1){
                        $dado[] = 'sim';
                }else{
                        $dado[] = 'Não';
                }
                if($cogitative->dinner == 1){
                        $dado[] = 'sim';
                }else{
                        $dado[] = 'Não';
                }
                $dado[] = "
                    <button class='btn btn-primary'  data-toggle='modal' data-target='#admineditarranchamento' data-id='".$cogitative->id."'><i class='fa fa-pen '></i></button>
                    <button class='btn btn-danger'  onclick='return delete_arranchamento(".$cogitative->id.") '><i class='fa fa-trash'></i></button>
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
