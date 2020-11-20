<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingStation extends Model
{
    protected $table = "polling_stations";
    protected $fillable = ['name','description','constituency_id'];
}
