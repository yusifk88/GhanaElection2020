<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParliamentryCandidate extends Model
{
    protected $table = "parliamentary_candidate";
    protected $fillable = ['name','constituency_id','photo','party_id','rejected'];
}
