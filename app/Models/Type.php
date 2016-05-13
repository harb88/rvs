<?php namespace rvs\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'ref_types';
    protected $primaryKey = 't_id';
    public $timestamps = false;
    
    public function Unit()
    {
        return $this->hasMany('rvs\Models\Unit', 'ur_type');
    }
}