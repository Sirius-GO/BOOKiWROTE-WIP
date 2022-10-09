<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
      //Table Name
  protected $table = 'genres';
  //Primary Key
  public $primaryKey = 'g_id';
  //Timestamps
  public $timestamps = true;
}