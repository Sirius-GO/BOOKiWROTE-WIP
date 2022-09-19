<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Narrator extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'narrators';
    //Primary Key
    public $primaryKey = 'narrator_id';
    //Timestamps
    public $timestamps = true;


    public function books(){
        return $this->belongsTo('App\Models\Book');
    }

}
