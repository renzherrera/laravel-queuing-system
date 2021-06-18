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

    public function getQueueRelation(){
                                        //foreing key of queue / id of owner
        return $this->hasMany(Queue::class, 'service_id', 'id');

    }

    public function getCounterRelation()
    {
        return $this->belongsTo(Counter::class, 'service_id', 'id');
    }
    

}
