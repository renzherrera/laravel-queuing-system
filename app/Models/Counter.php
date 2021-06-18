<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'counter_name',
        'service_id',
        'is_active',
    ];
    // public function getUserRelation()
    // {
    //     return $this->belongsTo(User::class, 'id', 'counter_id');
    // }    

    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    

    public function queues()
    {
        return $this->hasMany(Queue::class, 'queue_id', 'queue_id');
    }
}
