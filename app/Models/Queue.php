<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;
    protected $primaryKey = 'queue_id';
    protected $fillable = [
        'service_id',
        'ticket_number',
        'customer_id'
        

    ];

    public function services(){
        return $this->belongsTo(Service::class, 'id', 'queue_id');

    }
}
