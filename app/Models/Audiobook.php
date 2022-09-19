<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Narrator;

class Audiobook extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'audio_snippets';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;


    public function books(){
        return $this->belongsTo('App\Models\Book');
    }

    public function narrators(){
        return $this->belongsTo('App\Models\Narrator', 'narrator_id');
    }

}
