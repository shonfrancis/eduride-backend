<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $guarded = [];

    protected $casts = [
        'media' => 'array',
        'preferred_days' => 'array',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function scopeTutorAds($query)
    {
        return $query->whereIn('type', ['tutor', 'lsa']);
    }

    public function scopeStudentAds($query)
    {
        return $query->where('type', 'student_requirement');
    }
}
