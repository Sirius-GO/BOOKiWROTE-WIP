<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Author extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'authors';
    //Primary Key
    public $primaryKey = 'author_id';
    //Timestamps
    public $timestamps = true;


    public function books(){
        return $this->belongsTo('App\Models\Book');
    }

}
