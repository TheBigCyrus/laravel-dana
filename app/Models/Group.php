<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'owner_id' , 'id');
    }

    public function todos() : HasMany
    {
        return $this->hasMany(Todo::class);
    }
    public function members() : HasMany
    {
        return $this->hasMany(Member::class);
    }
}
