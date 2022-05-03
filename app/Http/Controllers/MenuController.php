<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //CARDAPIO
    public function menu(){
        return view('menu');
    }
    //BUSCANDO INFORMAÇÔES DO CARDAPIO
    public function get_edit_menu($id){
        $data = MenuModel::find($id);
        return $data;
    }
    //CARDAPIO DO DIA
    public function menu_day(){
        $data = MenuModel::where('date', date('Y-m-d'))->first();

        if($data){
            switch (session('user')['company']['id']) {
                case 2:
                    $date = $data['h_ccsv'];
                break;
                case 3:
                    $date = $data['h_cia1'];
                break;
                case 4:
                    $date = $data['h_cia2'];
                break;
                case 5:
                    $date = $data['h_cia3'];
                break;
            }
            $menu = [
                'brekker'=> $data['brekker'],
                'lunch' => $data['lunch'],
                'dinner' => $data['dinner'],
                'displacement' => date('H:m', strtotime($date))
            ];
        }else{
            $menu = [
            'brekker'=> 'Sem cardápio disponível.',
            'lunch' => 'Sem cardápio disponível.',
            'dinner' => 'Sem cardápio disponível.',
            'h_lunch' => 'Indísponivel.'
            ];
        }


        return $menu;
    }
    //DELETAR CARDAPIO
    public function delete_menu($id){
        MenuModel::find($id)->forceDelete();
    }


    // POSTs //
    //NOVO CARDAPIO
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
            $new_arranchamento->h_ccsv = $data['h_ccsv'];
            $new_arranchamento->h_cia1 = $data['h_cia1'];
            $new_arranchamento->h_cia2 = $data['h_cia2'];
            $new_arranchamento->h_cia3 = $data['h_cia3'];
            $new_arranchamento->save();
        }


    }
    //EDITAR CARDAPIO
    public function edit_menu(Request $request)
    {
        $data = $request->all();

        $menu = MenuModel::find($data['id_edit']);

        $menu->updatedby = session('user')['rank']." ".session('user')['professionalName'];
        $menu->date = date('Y-m-d', strtotime($data['date']));
        $menu->brekker = $data['brekker'];
        $menu->lunch = $data['lunch'];
        $menu->dinner = $data['dinner'];
        $menu->h_ccsv = $data['h_ccsv'];
        $menu->h_cia1 = $data['h_cia1'];
        $menu->h_cia2 = $data['h_cia2'];
        $menu->h_cia3 = $data['h_cia3'];
        $menu->save();

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
            4=> 'id',
            5=> 'date',
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
                 $dado[] = 'CCSv: '.date('H:m',strtotime($food->h_ccsv)).'<br> 1ª Cia: '.date('H:m',strtotime($food->h_cia1)).'<br> 2ª Cia: '.date('H:m',strtotime($food->h_cia2)).'<br> 3ª Cia: '.date('H:m',strtotime($food->h_cia3));
                if(session('Arranchamento')['profileType'] == 1){
                    $dado[] = $food->updatedby;
                   $dado[] = "
                    <button class='btn btn-primary' onclick='return edit_menu(".$food->id.")'><i class='fa fa-pen '></i></button>
                    <button class='btn btn-danger'  onclick='return delete_menu(".$food->id.")'><i class='fa fa-trash'></i></button>
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
