<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'uniqueId','facility_id', 'delivery_id', 'category', 'nafdac_number', 'name', 'manufacturer', 'shelf_name',  'prescription_slip', 'added_by'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
