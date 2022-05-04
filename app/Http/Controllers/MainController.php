<?php

namespace App\Http\Controllers;

use App\ArranchamentoModel;
use App\Http\Controllers\Controller;
use App\MenuModel;
use App\MilitaryModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // Início
    public function home(){

        switch (session('Arranchamento')['profileType']) {
            case 1:
                $data['date'] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
            $em = ArranchamentoModel::where('date',$data['date'])->where('company_id', 2);
            $data['em'] = [
                'brekker' => $em->where('brekker', 1)->count(),
                'lunch' => $em->where('lunch', 1)->count(),
                'dinner' => $em->where('dinner', 1)->count()
            ];


            $ccsv = ArranchamentoModel::where('date',$data['date'])->where('company_id', 2);
            $data['ccsv'] = [
                'brekker' => $ccsv->where('brekker', 1)->count(),
                'lunch' =>$ccsv->where('lunch', 1)->count(),
                'dinner' => $ccsv->where('dinner', 1)->count()
            ];

            $cia1 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 3);
            $data['cia1'] = [
                'brekker' => $cia1->where('brekker', 1)->count(),
                'lunch' =>$cia1->where('lunch', 1)->count(),
                'dinner' => $cia1->where('dinner', 1)->count()
            ];


            $cia2 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 4);
            $data['cia2'] = [
                'brekker' => $cia2->where('brekker', 1)->count(),
                'lunch' =>$cia2->where('lunch', 1)->count(),
                'dinner' => $cia2->where('dinner', 1)->count()
            ];

            $cia3 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 5);
            $data['cia3'] = [
                'brekker' => $cia3->where('brekker', 1)->count(),
                'lunch' =>$cia3->where('lunch', 1)->count(),
                'dinner' => $cia3->where('dinner', 1)->count()
            ];
            return view('homeadmin', $data);
                break;
                case 2:
                 $data['date'] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
            $em = ArranchamentoModel::where('date',$data['date'])->where('company_id', 2);
            $data['em'] = [
                'brekker' => $em->where('brekker', 1)->count(),
                'lunch' => $em->where('lunch', 1)->count(),
                'dinner' => $em->where('dinner', 1)->count()
            ];


            $ccsv = ArranchamentoModel::where('date',$data['date'])->where('company_id', 2);
            $data['ccsv'] = [
                'brekker' => $ccsv->where('brekker', 1)->count(),
                'lunch' =>$ccsv->where('lunch', 1)->count(),
                'dinner' => $ccsv->where('dinner', 1)->count()
            ];

            $cia1 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 3);
            $data['cia1'] = [
                'brekker' => $cia1->where('brekker', 1)->count(),
                'lunch' =>$cia1->where('lunch', 1)->count(),
                'dinner' => $cia1->where('dinner', 1)->count()
            ];


            $cia2 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 4);
            $data['cia2'] = [
                'brekker' => $cia2->where('brekker', 1)->count(),
                'lunch' =>$cia2->where('lunch', 1)->count(),
                'dinner' => $cia2->where('dinner', 1)->count()
            ];

            $cia3 = ArranchamentoModel::where('date',$data['date'])->where('company_id', 5);
            $data['cia3'] = [
                'brekker' => $cia3->where('brekker', 1)->count(),
                'lunch' =>$cia3->where('lunch', 1)->count(),
                'dinner' => $cia3->where('dinner', 1)->count()
            ];
            return view('homefurriel', $data);

            default:
                return view('home');
                break;
        }
    }

    //EDITAR ARRANCHAMENTO
    public function get_edit_arranchamento($id){
        return ArranchamentoModel::where('id', $id)->with('military')->first();
    }
    //EXCLUIR ARRANCHAMENTO
    public function get_delete_arranchamento($id){
        ArranchamentoModel::where('user_id', session('user')['id'])->where('id', $id)->first()->delete();
    }

    public function arranchar_cia(){
        $data = MilitaryModel::where('company_id',2)->get();

        foreach ($data as $d) {
            echo $d."<br><br>";
        }
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


            $editarrachamento->brekker = $data['brekker'];
            $editarrachamento->lunch = $data['lunch'];
            $editarrachamento->dinner = $data['dinner'];
            $editarrachamento->save();



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
