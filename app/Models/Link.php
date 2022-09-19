<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
      //Table Name
  protected $table = 'book_links';
  //Primary Key
  public $primaryKey = 'id';
  //Timestamps
  public $timestamps = true;
}