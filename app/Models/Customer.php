<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'queue_number', 'status', 'service_id'];

    public function service()
{
    return $this->belongsTo(Service::class);
}

}
