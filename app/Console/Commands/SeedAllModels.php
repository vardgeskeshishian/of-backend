<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SeedAllModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-all-models {--times=1}';

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

        $exceptions = [
            'User',
            'userFilterCondition',
        ];

        $modelPath = app_path('Models');

        $modelFiles = File::allFiles($modelPath);
        foreach ($modelFiles as $file) {
            $className = Str::replaceLast('.php', '', $file->getFilename());

            if (in_array($className, $exceptions)) {
                $this->warn("Skipping {$className}: Class is in exceptions.");
                continue;
            }

            $fullClassName = "App\\Models\\{$className}";
            $fullFactoryClassName = "Database\\Factories\\{$className}Factory";
            if (class_exists($fullClassName) && class_exists($fullFactoryClassName)) {
                $this->info("Seeding {$className} with {$times} instances...");

                DB::beginTransaction();
                try {
                    for ($i = 0; $i < $times; $i++) {
                        $fullClassName::factory()->create();
                    }
                    DB::commit();
                    $this->info("Successfully seeded {$className}.");
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->error("Failed to seed {$className}: " . $e->getMessage());
                }
            } else {
                $this->warn("Skipping {$className}: Factory not found.");
            }
        }
        $this->info("Seeding completed.");
    }
}
