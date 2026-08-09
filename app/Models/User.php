<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'location', 'religion', 'nationality', 'education_status', 'education_degree', 'avatar', 'gender', 'birth_date', 'application_status', 'language_preference', 'is_active', 'google_id', 'google_token',
        'headline', 'linkedin_url', 'years_of_experience', 'recommendation_letter', 'worker_type',
        'confession_father', 'applicant_church', 'current_company', 'employment_status', 'application_date', 'languages', 'microsoft_office_skills', 'experience_details', 'last_salary',
        'admin_rating', 'admin_notes'
    ];

    protected $hidden = [
        'password', 'remember_token', 'google_token', 'google_id'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'is_active' => 'boolean',
            'application_status' => 'string',
            'languages' => 'array',
            'application_date' => 'date'
        ];
    }

    public function company() { return $this->hasOne(Company::class); }
    public function resumes() { return $this->hasMany(Resume::class); }
    public function applications() { return $this->hasMany(Application::class); }
    public function savedJobs() { return $this->hasMany(SavedJob::class); }
    public function userSkills() { return $this->hasMany(UserSkill::class); }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
