<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	/**
	 * Soft deletes keeps the record in DB and marks it as deleted
	 */
	use SoftDeletes;
	protected $dates = ['deleted_at','created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'vendor_id', 
        'proposed_date1',
        'proposed_date2',
        'proposed_date3',
        'proposed_postal_code',
        'proposed_street_name',
        'confirmed_date_index',
        'confirmed_by',
        'remarks',
        'status',
        'created_by',
    ];

    public function getCreatedAtAttribute($value){
      
        $date = date('Y-m-d H:i:s',strtotime($value));
        return $date;
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company','vendor_id')->withTrashed();
    }
	
	public function created_user()
    {
        return $this->belongsTo('App\Models\User','created_by')->withTrashed();
    }

    public function confirmed_user()
    {
        return $this->belongsTo('App\Models\User','created_by')->withTrashed();
    }
	
}