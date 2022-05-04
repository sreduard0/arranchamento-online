<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArranchamentoModel extends Model
{
     public function military()
    {
        return $this->hasOne('App\MilitaryModel', 'id', 'user_id')->with('rank');
    }
    use HasFactory;
    use SoftDeletes;
    protected $table = 'arranchamentos';
    protected $primarykey = 'id';
}
