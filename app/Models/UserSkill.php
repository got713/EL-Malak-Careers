<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSkill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'skill_id', 'years_experience'];

    public function user() { return $this->belongsTo(User::class); }
    public function skill() { return $this->belongsTo(Skill::class); }
}
