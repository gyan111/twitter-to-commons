<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewAccountRequest extends Model
{
     protected $fillable = [
        'handle', 'name', 'template', 'category', 'author', 'otrs'
    ];
    //get the user of the upload
    public function user()
    {
        return $this->belongsTo('App\User', 'approved_by');
    }
}
