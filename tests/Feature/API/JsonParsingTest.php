<?php

namespace API;

use App\Models\SyncHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class JsonParsingTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_can_successfully_parse_json_file()
    {

        $filePath = base_path('tests/Utils/assets/parsing/correct.json');

        $user = User::factory()->create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'api_token' => Str::random(80),
        ]);

        $this->assertFileExists($filePath);

        $jsonData = json_decode(file_get_contents($filePath), true);

        Log::isFake();

        $response = $this->postJson(
            '/api/v1/parse',
            $jsonData,
            [
                'Authorization' => 'Bearer ' . $user->api_token,
                'Content-Type' => 'application/json',
            ],
        );

        Log::shouldReceive('info')
            ->with('Json was successfully parsed and insert in database');

        $syncHistory = SyncHistory::query()->first();

        $this->assertNotNull($syncHistory);

        $this->assertDatabaseHas('sync_histories', [
            'status' => 'success',
        ]);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson(['status' => 'success']);
    }
}
