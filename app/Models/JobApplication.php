<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default "job_applications"
    protected $table = 'jobapplications';

    protected $fillable = [
        'job_id',
        'fullname',
        'email',
        'phone',
        'status',
        'resume',
    ];

    // Define the relationship with CareerJob model (one JobApplication belongs to one CareerJob)
    public function careerJob()
    {
        return $this->belongsTo(CareerJob::class, 'job_id');
    }

    public $timestamps = true;
}
