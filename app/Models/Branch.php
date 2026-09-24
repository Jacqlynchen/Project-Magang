<?php

namespace App\Models;

use App\Models\Concerns\HasStatusLogs;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasStatusLogs;

    protected $table = 'branches';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'code',
        'name',
        'area',
        'est_run_at',
        'status_logs_id',
    ];

    protected $casts = [
        'est_run_at' => 'date',
    ];

    public function address()
    {
        return $this->morphOne(\App\Models\Address::class, 'modelable');
    }
}