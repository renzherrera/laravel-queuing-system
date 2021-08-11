<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;
    protected $primaryKey = 'queue_id';
    protected $dates = ['created_at', 'updated_at','called','served','missed'];
    protected $fillable = [
        'service_id',
        'ticket_number',
        'customer_id'
        

    ];

    public function getServiceRelation(){
        return $this->belongsTo(Service::class, 'service_id', 'id');

    }

    

    
    
}
