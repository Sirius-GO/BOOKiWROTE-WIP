<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Narrator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $casts = [
        'title' => 'App\Casts\TitleCast',
    ];

    public function authors(){
        return $this->belongsTo('App\Models\Author', 'book_author_id');
    }

    public function narrators(){
        return $this->hasOne('App\Models\Narrator', 'narrator_id');
    }

}
