<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class DropMembershipTableAndMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop:membership-table-and-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop Membership Table and Migration Record';

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
        if(DB::table('migrations')->where('migration', '=', '2022_01_14_102908_create_memberships_table')->delete()) {
            $this->info('Membership migration deleted successfully.');
        }

        if(DB::statement('DROP TABLE memberships')) {
            $this->info('Membership table dropped successfully.');
        }
    }
}
