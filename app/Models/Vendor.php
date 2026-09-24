<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Net Sites where this vendor is the primary vendor.
     */
    public function primaryNetSites()
    {
        return $this->hasMany(NetSite::class, 'pri_vendor_id');
    }

    /**
     * Net Sites where this vendor is the secondary vendor.
     */
    public function secondaryNetSites()
    {
        return $this->hasMany(NetSite::class, 'sec_vendor_id');
    }
}