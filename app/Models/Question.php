<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function actions(): MorphMany
    {
        return $this->morphMany(Action::class, 'target');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
