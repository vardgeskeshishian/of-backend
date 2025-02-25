<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\SecurityResource;
use App\Models\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SecurityController extends Controller
{
    #[OA\Get(
        path: '/v1/securities',
        description: 'Display a collection of Items.',
        tags: ['Security'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): SecurityResource
    {
        return new SecurityResource(
            Security::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/securities/{id}',
        description: 'Display the specified Item.',
        tags: ['Security'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Security $security): SecurityResource
    {
        return new SecurityResource(
            $security,
        );
    }
}
