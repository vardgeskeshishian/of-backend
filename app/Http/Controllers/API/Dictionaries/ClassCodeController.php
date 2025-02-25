<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassCodeResource;
use App\Models\ClassCode;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClassCodeController extends Controller
{
    #[OA\Get(
        path: '/v1/class-codes',
        description: 'Display a collection of Items.',
        tags: ['ClassCode'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ClassCodeResource
    {
        return new ClassCodeResource(
            ClassCode::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/class-codes/{id}',
        description: 'Display the specified Item.',
        tags: ['ClassCode'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(ClassCode $classCode): ClassCodeResource
    {
        return new ClassCodeResource(
            $classCode,
        );
    }
}
