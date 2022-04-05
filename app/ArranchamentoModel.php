<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArranchamentoModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'arranchamentos';
    protected $primarykey = 'id';
}
