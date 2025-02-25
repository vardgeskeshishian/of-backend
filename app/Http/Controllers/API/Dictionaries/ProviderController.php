<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProviderController extends Controller
{
    #[OA\Get(
        path: '/v1/providers',
        description: 'Display a collection of Items.',
        tags: ['Provider'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ProviderResource
    {
        return new ProviderResource(
            Provider::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/providers/{id}',
        description: 'Display the specified Item.',
        tags: ['Provider'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Provider $provider): ProviderResource
    {
        return new ProviderResource(
            $provider,
        );
    }
}
