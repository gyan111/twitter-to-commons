<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
	//get the user of the upload
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
