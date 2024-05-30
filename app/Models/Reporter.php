<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporter extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class ,'reporter_id' , 'id');
    }
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class ,'topic_id' , 'id');
    }
}
