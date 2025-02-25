<?php

namespace Tests\Feature\Services;

use App\Models\AdministrativeDistrictType;
use App\Models\User;
use App\Services\JsonParsingService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Tests\TestCase;

class JsonParsingServiceTest extends TestCase
{
    use RefreshDatabase;
    private JsonParsingService $service;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new JsonParsingService();
    }

    /**
     * @throws Exception
     */
    public function testParseWithRandomFactoryData()
    {
        $this->service = new JsonParsingService();

        $model = AdministrativeDistrictType::factory()->create();

        $table = $model->getTable();

        $jsonRows = [$model::class => $model->toArray()];

        $result = $this->service->parse($jsonRows);

        $this->assertTrue($result);

        $this->assertDatabaseHas($table, $model->toArray());
    }

    /**
     * @throws \Exception
     */
    public function testParseValidJSON()
    {
        $filePath = base_path('tests/Utils/assets/parsing/correct.json');

        $jsonRows = json_decode(file_get_contents($filePath), true);

        User::factory()->create(['id' => 1]);

        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('column-listing-for-assignments', Mockery::type('Closure'))
            ->andReturn(['id', 'name']);

        $result = $this->service->parse($jsonRows);

        $this->assertTrue($result);
    }

    /**
     * @throws \Exception
     */
    public function testValidateMoreColumnCount()
    {
        $filePath = base_path('tests/Utils/assets/parsing/more-fields.json');

        $jsonRows = json_decode(file_get_contents($filePath), true);

        User::factory()->create(['id' => 1]);

        try {
            $this->service->parse($jsonRows);
        } catch (Exception $e) {
            $this->assertStringContainsString('Request data count exceeds the expected', $e->getMessage());
        }
    }


    public function testValidateLessColumnCount()
    {
        $filePath = base_path('tests/Utils/assets/parsing/less-fields.json');

        $jsonRows = json_decode(file_get_contents($filePath), true);

        User::factory()->create(['id' => 1]);

        $this->withoutExceptionHandling();
        try {
            $this->service->parse($jsonRows);
        } catch (Exception $e) {
            $this->assertStringContainsString('Request data count is less', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function testValidateClassExistence()
    {
        $filePath = base_path('tests/Utils/assets/parsing/incorrect-model.json');

        $jsonRows = json_decode(file_get_contents($filePath), true);

        User::factory()->create(['id' => 1]);
        $this->withoutExceptionHandling();
        $this->expectException(Exception::class);
        $this->service->parse($jsonRows);
    }
}
