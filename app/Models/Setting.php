<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = ['key', 'value'];
    
    /**
     * Get a setting by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    /**
     * Set a setting
     */
    public static function set($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}