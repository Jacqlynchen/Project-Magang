<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetIssue extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function siteIssues()
    {
        return $this->hasMany(SiteIssue::class);
    }
}