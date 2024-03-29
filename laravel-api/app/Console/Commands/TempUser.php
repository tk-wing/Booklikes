<?php

namespace App\Console\Commands;

use App\Models\TemporaryUser;
use Illuminate\Console\Command;

class TempUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tempUser:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expiried records from temporaryUser';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time = now()->subHour(24);
        TemporaryUser::where('created_at', '<', $time)->delete();
    }
}
