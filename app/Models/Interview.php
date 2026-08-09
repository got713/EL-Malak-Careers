<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'scheduled_at', 'type', 'location_link', 'notes', 'status'
    ];

    protected function casts(): array { return ['scheduled_at' => 'datetime']; }

    public function application() { return $this->belongsTo(Application::class); }
}
