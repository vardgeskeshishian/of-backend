<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\API\APIController;
use App\Http\Resources\AgreementTypeResource;
use App\Models\AgreementType;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AgreementTypeController extends APIController
{
    #[OA\Get(
        path: '/v1/agreement-types',
        description: 'Display a collection of Items.',
        tags: ['AgreementType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): JsonResource
    {
        return AgreementTypeResource::collection(
            AgreementType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/agreement-types/{id}',
        description: 'Display the specified Item.',
        tags: ['AgreementType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(AgreementType $agreementType): AgreementTypeResource
    {
        return new AgreementTypeResource(
            $agreementType,
        );
    }
}
