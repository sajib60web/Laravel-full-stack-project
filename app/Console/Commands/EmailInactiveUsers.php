<?php

namespace App\Console\Commands;

use App\Notifications\NotifyInactiveUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email inactive user';

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
        $limit = Carbon::now()->subDay(7);
        $inactive_user = User::where('last_login', '2019-07-12 12:04:06')->get();

        foreach ($inactive_user as $user)
        {
            $user->notify(new NotifyInactiveUser());
            $this->info('Email send to - '.$user->email);
        }
    }
}
