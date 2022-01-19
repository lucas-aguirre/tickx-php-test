<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Helpers\ResponseCodeHelper;

class ResponseHelper
{
    private const SUCCESS = 'success';
    private const ERROR   = 'error';
    
    public static function responseOk(string $message = null, $result = null, bool $status = self::SUCCESS)
    {
        return self::jsonResponse($status, ResponseCodeHelper::HTTP_OK, $message, $result);
    }
    
    public static function responseCreated(string $message = 'Created', $result = null)
    {
        return self::jsonResponse(
            self::SUCCESS,
            ResponseCodeHelper::HTTP_CREATED,
            $message,
            $result
        );
    }
    
    public static function responseBadRequest(string $message = 'Bad request')
    {
        return self::jsonResponse(
            self::ERROR,
            ResponseCodeHelper::HTTP_BAD_REQUEST,
            $message
        );
    }
    
    public static function responseUnprocessableEntity(string $message = 'Unprocessable entity')
    {
        return self::jsonResponse(
            self::ERROR,
            ResponseCodeHelper::HTTP_UNPROCESSABLE_ENTITY,
            $message
        );
    }
    
    private static function jsonResponse(
        string $status,
        int $responseCode,
        string $message = null,
        mixed $result = null
    ) {
        $data = [
            'status'  => $status,
            'message' => $message,
            'result'  => $result
        ];

        return json_encode([$data, $responseCode]);
    }
}