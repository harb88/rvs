<?php namespace rvs\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'ref_status';
    protected $primaryKey = 's_id';
    public $timestamps = false;
    
    public function Unit()
    {
        return $this->hasMany('rvs\Models\Unit', 'ur_status');
    }
}