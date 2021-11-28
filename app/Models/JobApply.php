<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;
    public function singlejob(){
        return $this->belongsTo(Job::class,'job_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
