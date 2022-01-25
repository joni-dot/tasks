<?php

namespace App\Console\Commands;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user and save user to the database.';

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
     * @return int
     */
    public function handle()
    {
        (new CreateNewUser)->create([
            'name' => $this->ask('What is the name?'),
            'email' => $this->ask('What is the email?'),
            'password' => $this->secret('What is the password?'),
            'password_confirmation' => $this->secret('Confirm password'),
        ]);
    }
}
