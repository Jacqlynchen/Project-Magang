<?php

namespace App\Models;

use App\Models\Concerns\HasStatusLogs;
use Illuminate\Database\Eloquent\Model;

class NetSite extends Model
{
    use HasStatusLogs;

    protected $table = 'net_sites';

    protected $fillable = [
        'name',
        'addr_1',
        'addr_2',
        'addr_3',
        'lat',
        'long',
        'sid',
        'ip_segment',
        'speed',
        'amount',
        'branch_id',
        'pri_vendor_id',
        'sec_vendor_id',
        'user_id',
        'status_logs_id',
    ];

    protected $casts = [
        'lat' => 'decimal:7',
        'long' => 'decimal:7',
        'amount' => 'decimal:2',
        'speed' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function primaryVendor()
    {
        return $this->belongsTo(Vendor::class, 'pri_vendor_id');
    }

    public function secondaryVendor()
    {
        return $this->belongsTo(Vendor::class, 'sec_vendor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}