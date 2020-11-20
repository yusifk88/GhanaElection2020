<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = "votes";
    protected $fillable=['polling_station_id','candidate_id','votes','type','rejected'];
}
