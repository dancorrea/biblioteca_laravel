<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'surname'];

    public function books()    {
       return $this->belongToMany('App\Models\Books', 'books_authors');
    }
}