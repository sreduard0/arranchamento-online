<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankModel extends Model
{
    use HasFactory;
     //Nome da tabela vinculada, caso nao seja especificado sera usado o nome da clase model para saber a tabela
    protected $table = 'ranks';
    //Chave primaria da tabela, caso não seja definido por default e 'ID'
    protected $primaryKey = 'id';
    //Conexão DB a ser usada
    protected $connection = 'sistao';
}
