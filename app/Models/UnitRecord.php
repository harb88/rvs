<?php namespace rvs\Models;

use Illuminate\Database\Eloquent\Model;

class UnitRecord extends Model
{
    protected $table = 'tbl_unitRecords';
    protected $primaryKey = 'ur_id';
    
    public function Unit()
    {
        return $this->belongsTo('rvs\Models\Unit', 'ur_unit', 'u_id');
    }
    public function Status()
    {
        return $this->belongsTo('rvs\Models\Status', 'ur_status', 's_id');
    }
    public function Type()
    {
        return $this->belongsTo('rvs\Models\Type','ur_type', 't_id');
    }
}