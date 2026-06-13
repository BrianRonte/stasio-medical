<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    protected $fillable = ['name', 'title', 'specialty', 'department_id', 'bio', 'days'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim(preg_replace('/^Dr\.?\s+/i', '', $this->name)));
        $first = mb_substr($parts[0] ?? '', 0, 1);
        $last  = mb_substr(end($parts) ?: '', 0, 1);

        return mb_strtoupper($first . $last);
    }
}
