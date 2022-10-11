<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stories extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function users(){
        return $this->belongsTo('App\Models\User', 'uid');
    }


}
