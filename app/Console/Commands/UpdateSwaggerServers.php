<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateSwaggerServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-swagger-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = storage_path('api-docs/api-docs.json');

        if (!File::exists($filePath)) {
            $this->error('File does not exist at ' . $filePath);
            return 1;
        }

        $json = File::get($filePath);
        $data = json_decode($json, true);

        if ($data === null) {
            $this->error('Failed to decode JSON.');
            return 1;
        }

        $data['servers'] = [
            [
                'url' => config('of-swagger.api_url'),
                'description' => 'Server parameters',
            ],
        ];

        $newJson = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        File::put($filePath, $newJson);

        $this->info('Swagger servers section updated successfully.');

        return 0;
    }
}
