<?php

namespace App\Models;

use App\Models\Concerns\HasStatusLogs;
use Illuminate\Database\Eloquent\Model;

class SiteIssue extends Model
{
    use HasStatusLogs;

    protected $fillable = [
        'net_site_id',
        'net_issue_id',
        'employee_id',
        'remark',
        'status_logs_id',
    ];

    public function netSite()
    {
        return $this->belongsTo(NetSite::class);
    }

    public function netIssue()
    {
        return $this->belongsTo(NetIssue::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}