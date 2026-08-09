<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id', 'user_id', 'resume_id', 'cover_letter', 'status', 'applied_at'
    ];

    protected function casts(): array { return ['applied_at' => 'datetime']; }

    public function job() { return $this->belongsTo(Job::class, 'job_posting_id'); }
    public function user() { return $this->belongsTo(User::class); }
    public function resume() { return $this->belongsTo(Resume::class); }
    public function interview() { return $this->hasOne(Interview::class); }
}
