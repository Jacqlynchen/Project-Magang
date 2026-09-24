<?php

namespace App\Models\Concerns;

use App\Models\StatusLog;

trait HasStatusLogs
{
    /**
     * The status log entry this model currently points to.
     */
    public function currentStatusLog()
    {
        return $this->belongsTo(StatusLog::class, 'status_logs_id');
    }

    /**
     * Full status history for this model.
     */
    public function statusLogs()
    {
        return $this->morphMany(StatusLog::class, 'modelable');
    }

    /**
     * Record a new status log entry and point status_logs_id to it.
     */
    public function applyStatus(int $statusId, ?string $remark = null, ?int $userId = null): StatusLog
    {
        $log = $this->statusLogs()->create([
            'status_id' => $statusId,
            'remark' => $remark,
            'users_id' => $userId ?? auth()->id(),
        ]);

        $this->update(['status_logs_id' => $log->id]);

        return $log;
    }
}