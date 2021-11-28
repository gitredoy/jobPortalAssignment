<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(JobType::class,'job_types_id','id')->withDefault(['title'=>'Not Assign']);
    }
    public function apply(){
        return $this->hasMany(JobApply::class,'job_id','id');
    }
}
