<?php

namespace App\Console\Commands;

use App\Models\Building;
use App\Models\CommonBlock;
use App\Models\RentBlock;
use App\Models\SaleBlock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MockBuildingsWithRelations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mock-buildings-with-relations {--times=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $times = (int) $this->option('times');
        $this->info("Mock buildings with relations $times times...");
        DB::beginTransaction();
        try {
            for ($i = 0; $i < $times; $i++) {
                Building::factory(1)
                    ->create()
                    ->each(function ($building) {
                        CommonBlock::factory(1)
                            ->create(['building_id' => $building->id])
                            ->each(function ($commonBlock) {
                                RentBlock::factory(1)
                                    ->create(['common_block_id' => $commonBlock->id]);

                                SaleBlock::factory(1)
                                    ->create(['common_block_id' => $commonBlock->id]);
                            });
                    });
            }
            DB::commit();
            $this->info('DB updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('You have some error, check logs');
            Log::info(__METHOD__ . ' :Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ]);
        }
    }
}
