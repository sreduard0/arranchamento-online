<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitorsModel extends Model
{
    public function enterprise()
    {
        return $this->hasOne('App\Models\EnterpriseModel', 'id', 'enterprise_id')->withTrashed();
    }
    use HasFactory;
    use SoftDeletes;
    protected $table = 'visitors';
    protected $primarykey = 'id';
}
