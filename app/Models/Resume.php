<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'file_path', 'original_name', 'is_primary', 'description'
    ];

    protected static function booted()
    {
        static::saved(function ($resume) {
            \Illuminate\Support\Facades\Cache::forget('resumes_total_count');
        });

        static::deleted(function ($resume) {
            \Illuminate\Support\Facades\Cache::forget('resumes_total_count');
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function applications() { return $this->hasMany(Application::class); }
}
