<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'unique_id','facility_id', 'delivery_id', 'category', 'nafdac_number', 'name', 'manufacturer', 'shelf_name', 'added_by'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
