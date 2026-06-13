<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['code', 'name', 'tagline', 'details', 'colour', 'sort_order'];

    public function getDetailsListAttribute(): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", (string) $this->details))));
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
