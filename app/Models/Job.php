<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'company_id', 'title', 'description', 'requirements', 'type', 'location', 'salary_range', 'status', 'is_featured', 'vacancies', 'experience_years'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function applications() { return $this->hasMany(Application::class, 'job_posting_id'); }
    public function savedByUsers() { return $this->hasMany(SavedJob::class, 'job_posting_id'); }

    protected function salaryRange(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn ($value) => $value ? preg_replace_callback('/\d{4,}/', fn($m) => number_format($m[0]), $value) : $value,
        );
    }
}
