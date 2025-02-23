<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateVacancies extends Model
{
    use HasFactory;

    protected $fillable = ['candidate_id','vacancy_id'];

}
