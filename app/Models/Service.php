<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department_id',
        'prefix',
        'default_number',
        'is_active',
    ];

    public function queues(){
        return $this->Many(Queue::class, 'service_id', 'id');

    }
}
