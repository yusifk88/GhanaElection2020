<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = "parties";
    protected $fillable=['name','acronym','color','symbol_url'];

}
