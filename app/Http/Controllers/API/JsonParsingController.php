<?php

namespace App\Http\Controllers\API;

use OpenApi\Attributes as OA;
use App\Mail\JsonParsingErrorNotification;
use App\Services\JsonParsingService;
use App\Services\SyncHistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JsonParsingController extends APIController
{
    #[OA\Post(
        path: '/v1/parse',
        summary: 'Parse and store dynamic JSON data',
        tags: ['JSON Parsing'],
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                type: 'object',
                additionalProperties: true,
            ),
        ),
    )]
    #[OA\Response(
        response: 200,
        description: 'JSON parsed and stored successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
            ],
        ),
    )]
    #[OA\Response(
        response: 400,
        description: 'Invalid JSON data',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string', example: 'Invalid JSON data'),
            ],
        ),
    )]
    #[OA\Response(
        response: 422,
        description: 'Error during JSON parsing',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'error', type: 'string', example: 'Detailed error message'),
            ],
        ),
    )]
    #[OA\Response(
        response: 500,
        description: 'Server error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string', example: 'Server error'),
            ],
        ),
    )]
    public function __invoke(Request $request, JsonParsingService $jsonParsingService, SyncHistoryService $syncHistoryService): JsonResponse
    {
        /** @var array<int, array> $jsonRows */
        $jsonRows = $request->all();

        DB::beginTransaction();
        try {

            if (!$jsonParsingService->parse($jsonRows)) {
                throw new \Exception('Oops, something went wrong!');
            }

            DB::commit();

            Log::channel('of-json')->info('Json was successfully parsed and insert in database');

            $syncHistoryService->record('success', $jsonRows);

            return $this->successResponse();

        } catch (\Exception $e) {

            DB::rollBack();

            Mail::to(config('of-configs.operator_mails'))->send(
                new JsonParsingErrorNotification($e->getMessage()),
            );

            Log::channel('of-json')->info($e->getMessage());

            $syncHistoryService->record('error', $jsonRows, $e->getMessage());

            return $this->errorResponse();

        }

    }
}
