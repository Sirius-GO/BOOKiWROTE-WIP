<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Nlink;
use App\Models\Audiobook;
use App\Models\Author;

class Narrator extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'narrators';
    //Primary Key
    public $primaryKey = 'narrator_id';
    //Timestamps
    public $timestamps = true;


    public function nlinks(){
        return $this->hasMany('App\Models\Nlink', 'narrator_id');
    }

    public function audiobooks(){
        return $this->hasMany('App\Models\Audiobook', 'narrator_id');
    }

}
