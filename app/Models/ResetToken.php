<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResetToken extends Model
{
    use HasFactory;

    protected $table = "password_reset_tokens";

    protected $fillable = ['email', 'token', 'created_at'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
