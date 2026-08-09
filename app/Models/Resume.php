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

    public function user() { return $this->belongsTo(User::class); }
    public function applications() { return $this->hasMany(Application::class); }
}
