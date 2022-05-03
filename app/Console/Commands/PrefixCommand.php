<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Console\Events\CommandStarting;

class PrefixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pefix:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command before any other commands';
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
     * Run this command before any other commands
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommandStarting $event): void
    {
        if (app()->environment(['production'])) {
            if ($event->command === 'migrate:fresh') {
                $this->output = $event->output;
                $this->info('You cannot run this command in production.');
                die();
            }
        }
    }
}