<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'queue_id',
        'counter_id',
    ];
    public function queues() {
        return $this->belongsTo(Queue::class);

    }
}
