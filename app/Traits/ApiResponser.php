<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Exception;

trait ApiResponser
{
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json($data, $code);
    }

    public function errorResponse($message, $code, $error = null)
    {
        if ($error != null)
            report($error->getMessage());

        return response()->json(['message' => $message, 'code' => $code], $code);
    }

    public function errorUnprocessableEntityResponse($message)
    {
        return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function errorNotFoundResponse($message = '404 Not Found')
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    public function errorForbiddenResponse($message = '403 Requesting the URL is prohibited')
    {
        return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }

    public function handlerException($message)
    {
        throw new Exception($message, 1);
    }
}
