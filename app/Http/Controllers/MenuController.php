<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //Menu
    public function menu(){
        return view('menu');
    }

    //MENU DO DIA
    public function menu_day(){
        $data = MenuModel::where('date', date('Y-m-d'))->first();

        if($data){
            $menu = $data;
        }else{
            $menu = [
            'brekker'=> 'Sem cardápio disponível.',
            'lunch' => 'Sem cardápio disponível.',
            'dinner' => 'Sem cardápio disponível.'
            ];
        }


        return $menu;
    }


     // POSTs //
    //NOVO ARRANCHAMENTO
    public function new_menu(Request $request)
    {
        $data = $request->all();

        $checkarrachamento = MenuModel::where('date', date('Y-m-d', strtotime($data['date'])))->first();

        if($checkarrachamento)
        {
            return 'error';

        }else{

            $new_arranchamento = new MenuModel();
            $new_arranchamento->updatedby = session('user')['rank']." ".session('user')['professionalName'];
            $new_arranchamento->date = date('Y-m-d', strtotime($data['date']));
            $new_arranchamento->brekker = $data['brekker'];
            $new_arranchamento->lunch = $data['lunch'];
            $new_arranchamento->dinner = $data['dinner'];
            $new_arranchamento->save();
        }


    }

    //datatables CARDAPIOS
    public function get_menu(Request $request)
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

        if(session('Arranchamento')['profileType'] == 1){
             $menu = MenuModel::where('date','>=', date('Y-m-d'))->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($menu);
            $rows= count($menu);
        }else{
             $menu = MenuModel::where('date',date('Y-m-d'))->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($menu);
            $rows= count($menu);
        }



        // Ler e criar o array de dados
        $dados = array();
        foreach ($menu as $food){
            $dado = array();
            if($food->date == date('Y-m-d')){
                $dado[] = '<strong>Hoje<strong/>';
            }else{
                $dado[] = "<strong>".date('d-m-Y', strtotime($food->date))."<strong/>";
            }

                $dado[] = $food->brekker;
                $dado[] = $food->lunch;
                $dado[] = $food->dinner;
                if(session('Arranchamento')['profileType'] == 1){
                   $dado[] = "
                    <button class='btn btn-primary'  data-toggle='modal' data-target='#editfood' data-id='".$food->id."'><i class='fa fa-pen '></i></button>
                    <button class='btn btn-danger'  onclick='return delete_food(".$food->id.") '><i class='fa fa-trash'></i></button>
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
