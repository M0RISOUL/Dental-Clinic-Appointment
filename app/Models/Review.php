<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'appointment_id', 
        'user_id', 
        'rating', 
        'review', 
        'service', 
        'sentiment',
        'probability',
        'fullname'  
    ];
    
 
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getSentimentColorClass()
    {
        return match($this->sentiment) {
            'positive' => 'success',
            'negative' => 'danger',
            'neutral' => 'warning',
            default => 'secondary'
        };
    }
    
    public function getProbabilityPercentage()
    {
        return number_format($this->probability * 100, 1) . '%';
    }
    
    public function scopePositive($query)
    {
        return $query->where('sentiment', 'positive');
    }
    

    public function scopeNegative($query)
    {
        return $query->where('sentiment', 'negative');
    }
    
    public function scopeNeutral($query)
    {
        return $query->where('sentiment', 'neutral');
    }
}