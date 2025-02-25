<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Contact\Store;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class ContactController extends APIController
{
    #[OA\Post(
        path: '/v1/contacts',
        summary: 'Store contacts',
        tags: ['Contacts'],
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: 'multipart/form-data',
            schema: new OA\Schema(
                properties: [
                    new OA\Property(
                        property: 'type',
                        ref: '#/components/schemas/ContactTypes',
                        description: 'Contact type',
                        nullable: true,
                    ),
                    new OA\Property(property: 'name', description: 'Name', type: 'string', nullable: false),
                    new OA\Property(
                        property: 'phone',
                        description: 'Phone',
                        type: 'string',
                        example: '789456123',
                        nullable: true,
                    ),
                    new OA\Property(
                        property: 'email',
                        description: 'Email',
                        type: 'string',
                        example: 'example@gmail.com',
                        nullable: true,
                    ),
                    new OA\Property(
                        property: 'text',
                        description: 'text',
                        type: 'string',
                        example: 'Hello, send me expensive BC, please!',
                        nullable: true,
                    ),
                    new OA\Property(property: 'send_to_whatsapp', description: 'Send to WhatsApp', type: 'boolean', nullable: true),
                    new OA\Property(property: 'send_to_telegram', description: 'Send to Telegram', type: 'boolean', nullable: true),
                ],
            ),
        ),
    )]
    #[OA\Response(
        response: 200,
        description: 'Success',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'object'),
            ],
        ),
    )]
    public function store(Store $request): JsonResponse
    {
        try {

            Contact::query()->create($request->validated());

            return $this->successResponse();
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }
}
