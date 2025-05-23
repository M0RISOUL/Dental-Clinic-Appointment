<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerJob extends Model
{
    use HasFactory;

    protected $table = 'careerjobs';
    protected $fillable = [
        'title',
        'location',
        'jobtype',
        'workexperience',
        'salary',
        'description',
        'vacancy',
    ];

     public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_id')->onDelete('cascade');
    }

}
