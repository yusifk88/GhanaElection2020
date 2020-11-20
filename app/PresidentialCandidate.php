<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresidentialCandidate extends Model
{
    protected $table = "presidential_candidate";
    protected $fillable = [
        'name','party_id'
    ];
}
