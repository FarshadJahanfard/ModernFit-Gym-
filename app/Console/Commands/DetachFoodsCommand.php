<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DetachFoodsCommand extends Command
{
    protected $signature = 'foods:detach';
    protected $description = 'Detach foods from the user\'s dashboard daily.';

    public function handle()
    {
        // $detachedCount = DB::table('food_user')->whereDate('updated_at', '<', now())->delete();
        $detachedCount = DB::table('food_user')->delete();

        $this->info("Detached {$detachedCount} foods successfully.");
    }
}


