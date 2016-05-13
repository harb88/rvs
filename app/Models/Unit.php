<?php namespace rvs\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'tbl_units';
    protected $primaryKey = 'u_id';
    public $timestamps = false;
    public function UnitRecord()
    {
        return $this->hasMany('rvs\Models\UnitRecord', 'ur_unit');
    }
    public function Village()
    {
        return $this->belongsTo('rvs\Models\Village', 'u_village', 'v_id');
    }
}