<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = ['user_id', 'date_start', 'date_end', 'date_finish'];

    protected $dates = ['date_start', 'date_end', 'date_finish'];

    public function books()    {
       return $this->belongsToMany('App\Models\Book', 'books_lendings');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
