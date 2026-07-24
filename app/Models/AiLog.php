<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'image_path', 'analysis_result', 'shot_type', 'composition_score', 'color_palette', 'notes',
    ];

    protected $casts = [
        'analysis_result' => 'array',
        'color_palette' => 'array',
        'composition_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
