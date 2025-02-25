<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternetProviderTypeResource;
use App\Models\InternetProviderType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class InternetProviderTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/internet-provider-types',
        description: 'Display a collection of Items.',
        tags: ['InternetProviderType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): InternetProviderTypeResource
    {
        return new InternetProviderTypeResource(
            InternetProviderType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/internet-provider-types/{id}',
        description: 'Display the specified Item.',
        tags: ['InternetProviderType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(InternetProviderType $internetProviderType): InternetProviderTypeResource
    {
        return new InternetProviderTypeResource(
            $internetProviderType,
        );
    }
}
