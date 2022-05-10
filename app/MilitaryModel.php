<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryModel extends Model
{

     public function rank()
    {
        return $this->hasOne('App\RankModel', 'id', 'rank_id');
    }
    public function arranchamento()
    {
        $value = session('company_date_search');
        if(!empty($value)){
            $date = session('company_id_search');
        }else{
            $date = date('Y-m-d');
        }
        return $this->hasOne('App\ArranchamentoModel', 'user_id', 'id')->where('date',$date);
    }

    use HasFactory;
     //Nome da tabela vinculada, caso nao seja especificado sera usado o nome da clase model para saber a tabela
    protected $table = 'users';
    //Chave primaria da tabela, caso não seja definido por default e 'ID'
    protected $primaryKey = 'id';
    //Conexão DB a ser usada
    protected $connection = 'sistao';
}
