<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TaskLockRefresh implements ShouldQueue
{
    use Queueable;

    protected $task_id;

    /**
     * Create a new job instance.
     */
    public function __construct($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $task = Task::findOrFail($this->task_id);
        if ($task->locked_by && $task->locked_at) {
            $task->update([
                'locked_by' => null,
                'locked_at' => null
            ]);
        }
    }
}
