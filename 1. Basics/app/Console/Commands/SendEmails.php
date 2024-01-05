<?php

// php artisan make:command SendEmails

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user}'; // php artisan mail:send 2

    // Optional argument -> 'mail:send {user?}'
    // Optional argument with default value -> 'mail:send {user=foo}'
    // Multiple arguments -> 'mail:send {user*}' -> php artisan mail:send 1 2

    // Options without value -> 'mail:send {user} {--queue}'
    // Options with value -> 'mail:send {user} {--queue=}'
    // Options with default value -> 'mail:send {user} {--queue=default}'
    // Options Shortcut -> 'mail:send {user} {--Q|queue}' -> php artisan mail:send 3 -Q
    // Multiple options -> 'mail:send {--id=*}' -> php artisan mail:send --id=1 --id=2

    // Input Descriptions
    // protected $signature = 'mail:send
    //                     {user : The ID of the user}
    //                     {--queue : Whether the job should be queued}'

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        // Retrieve all arguments as an array...
        $arguments = $this->arguments();

        // Retrieve a specific argument...
        $userId = $this->argument('user');

        // Retrieve a specific option...
        // $queueName = $this->option('queue');

        // Retrieve all options as an array...
        $options = $this->options();

        // Prompting for Input
        $username = $this->ask('What is your username?');
        $password = $this->secret('What is the password?'); //input will be hidden

        // Asking for Confirmation
        if ($this->confirm('Do you want to subscribe to the newsletter?')) {
            // yes or y
            $this->line('User subscribed to the newsletter.');
        }

        // Auto-Completion
        $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        // $address = $this->anticipate('What is your address?', function ($input) {
        //     // Return auto-completion options...
        // });

        // Multiple Choice Questions
        $gender = $this->choice(
            'What is your gender?',
            ['Not specified', 'Male', 'Female', 'Others'],
            0, //$defaultIndex
            $maxAttempts = null, //optional
            $allowMultipleSelections = false //optional
        );
        $this->info('Gender: ' . $gender);

        $this->newLine(); // single blank line
        // $this->newLine(3) // three blank lines

        // Display Table
        $this->table(
            ['Name', 'Email'],
            User::all(['name', 'email'])->toArray()
        );

        // Display Progress Bar
        $users = $this->withProgressBar(User::all(), function ($user) {
            // $this->performTask($user)
        });


        // Calling Commands from Other Commands
        $this->call('msg:send', [
            'user' => 3, '--queue' => 'default'
        ]);

        // Call another console command and suppress all of its output
        $this->callSilently('msg:send', [
            'user' => 1, '--queue' => 'default'
        ]);
    }
}
