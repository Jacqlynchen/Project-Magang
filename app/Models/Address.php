<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat',
        'long',
        'addr_1',
        'addr_2',
        'addr_3',
        'modelable_id',
        'modelable_type',
    ];

    /**
     * Get the parent model (Branch, NetSite, etc.) that owns this address.
     */
    public function modelable()
    {
        return $this->morphTo();
    }
}