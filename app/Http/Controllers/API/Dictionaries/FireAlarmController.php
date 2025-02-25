<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\FireAlarmResource;
use App\Models\FireAlarm;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FireAlarmController extends Controller
{
    #[OA\Get(
        path: '/v1/fire-alarms',
        description: 'Display a collection of Items.',
        tags: ['FireAlarm'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): FireAlarmResource
    {
        return new FireAlarmResource(
            FireAlarm::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/fire-alarms/{id}',
        description: 'Display the specified Item.',
        tags: ['FireAlarm'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(FireAlarm $fireAlarm): FireAlarmResource
    {
        return new FireAlarmResource(
            $fireAlarm,
        );
    }
}
