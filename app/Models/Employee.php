<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'phone',
        'position_id',
        'position_title',
        'branch_code',
    ];

    /**
     * Linked by branch CODE, not id — this mimics data coming from
     * an external system that only knows the branch's public code.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_code', 'code');
    }

    public function siteIssues()
    {
        return $this->hasMany(SiteIssue::class);
    }
}