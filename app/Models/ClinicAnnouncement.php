<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'closure_start_date',
        'closure_end_date',    
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'closure_start_date' => 'date',  
        'closure_end_date' => 'date'     
    ];
}