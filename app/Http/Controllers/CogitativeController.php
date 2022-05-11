<?php

namespace App\Http\Controllers;

use App\ArranchamentoModel;
use App\Http\Controllers\Controller;
use App\MenuModel;
use App\MilitaryModel;
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
       $cia = session('company_id');

       if(!empty($cia)){
            $company = session('company_id');
       }else{
            $company = session('user')['company']['id'];
       }

        if( $requestData['columns'][1]['search']['value'])
        {
            $cogitatives = ArranchamentoModel::where('company_id', $company)->where('date', date('Y-m-d', strtotime($requestData['columns'][1]['search']['value'])))->with('military')->get()->sortBy('military.rank_id');
            $filtered = count($cogitatives);
            $rows = count(MilitaryModel::all());


            session()->put('company_date_search',date('Y-m-d', strtotime($requestData['columns'][1]['search']['value'])));

        }else{
              $cogitatives = ArranchamentoModel::where('company_id', $company)->where('date', date('Y-m-d'))->with('military')->get()->sortBy('military.rank_id');

            $filtered = count($cogitatives);
            $rows= count(MilitaryModel::all());
        }




        // Ler e criar o array de dados
        $dados = array();
        foreach ($cogitatives as $cogitative){
            $dado = array();
                $dado[] = $cogitative->military->rank->rankAbbreviation." ". $cogitative->military->professionalName;
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

    //BUSCANDO COGITATIVO DAS CIAS
    public function get_cogitative_day(){

            $data['date'] = date('Y-m-d');
            $em = ArranchamentoModel::where('date',$data['date'])->where('company_id', 1);
            $data['em'] = [
                'brekker' => $em->where('brekker', 1)->count(),
                'lunch' => $em->where('lunch', 1)->count(),
                'dinner' => $em->where('dinner', 1)->count(),
            ];

            $displacement = MenuModel::where('date',$data['date'])->first();
            $ccsv = ArranchamentoModel::where('date',$data['date'])->where('company_id', 2);
            if(!empty($displacement->h_ccsv)){
                $h_ccsv = date('H:m', strtotime($displacement->h_ccsv));
            }else{
                $h_ccsv = '00:00';
            }
            $data['ccsv'] = [
                'brekker' => $ccsv->where('brekker', 1)->count(),
                'lunch' =>$ccsv->where('lunch', 1)->count(),
                'dinner' => $ccsv->where('dinner', 1)->count(),
                'h_ccsv' => $h_ccsv
            ];

            $cia1 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 3);
            if(!empty($displacement->h_cia1)){
                $h_cia1 = date('H:m', strtotime($displacement->h_cia1));
            }else{
                $h_cia1 = '00:00';
            }
            $data['cia1'] = [
                'brekker' => $cia1->where('brekker', 1)->count(),
                'lunch' =>$cia1->where('lunch', 1)->count(),
                'dinner' => $cia1->where('dinner', 1)->count(),
                'h_cia1' => $h_cia1



            ];


            $cia2 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 4);
                if(!empty($displacement->h_cia2)){
                $h_cia2 = date('H:m', strtotime($displacement->h_cia2));
            }else{
                $h_cia2 = '00:00';
            }
            $data['cia2'] = [
                'brekker' => $cia2->where('brekker', 1)->count(),
                'lunch' =>$cia2->where('lunch', 1)->count(),
                'dinner' => $cia2->where('dinner', 1)->count(),
                 'h_cia2' =>  $h_cia2

            ];

            $cia3 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 5);
                if(!empty($displacement->h_cia3)){
                $h_cia3 = date('H:m', strtotime($displacement->h_cia3));
            }else{
                $h_cia3 = '00:00';
            }
            $data['cia3'] = [
                'brekker' => $cia3->where('brekker', 1)->count(),
                'lunch' =>$cia3->where('lunch', 1)->count(),
                'dinner' => $cia3->where('dinner', 1)->count(),
                 'h_cia3' =>  $h_cia3

            ];

            $total = ArranchamentoModel::where('date',$data['date']);
            $data['total'] = [
                'brekker' => $total->where('brekker', 1)->count(),
                'lunch' => $total->where('lunch', 1)->count(),
                'dinner' => $total->where('dinner', 1)->count()
            ];
        return $data;
    }

}
