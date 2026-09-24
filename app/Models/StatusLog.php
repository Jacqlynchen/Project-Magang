<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    protected $fillable = [
        'remark',
        'status_id',
        'users_id',
        'modelable_id',
        'modelable_type',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * The Branch, NetSite, etc. this log entry belongs to.
     */
    public function modelable()
    {
        return $this->morphTo();
    }
}