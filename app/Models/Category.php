<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title'];
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
}
