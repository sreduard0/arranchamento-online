<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'menu';
    protected $primarykey = 'id';
    protected $connection = 'arranchamento';
}
