<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MilitaryModel extends Model
{

     public function rank()
    {
        return $this->hasOne('App\RankModel', 'id', 'rank_id');
    }
    public function arranchamento()
    {

        return $this->hasOne('App\ArranchamentoModel', 'user_id', 'id')->where('date',date('Y-m-d', strtotime('+1 days')));
    }

    use HasFactory;
    use SoftDeletes;
     //Nome da tabela vinculada, caso nao seja especificado sera usado o nome da clase model para saber a tabela
    protected $table = 'users';
    //Chave primaria da tabela, caso não seja definido por default e 'ID'
    protected $primaryKey = 'id';
    //Conexão DB a ser usada
    protected $connection = 'sistao';
}
