<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HardDeleteUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hard-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hard delete users who have been soft deleted for more than 30 days';

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deletedUsers = User::onlyTrashed()
        ->where('deleted_at', '<', now()->subDays(30))
        ->get();
        $deletedUsersCount = $deletedUsers->count();

        foreach ($deletedUsers as $user) {
            $user->forceDelete();
        }
        $message = '[' . date('Y-m-d h:i:s') . '] Hard-Deleted:' . $deletedUsersCount;
        $this->info($message);
        Log::setDefaultDriver('batch');
        Log::info($message);
    }
}
