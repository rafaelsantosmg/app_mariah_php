<?php

namespace App\Traits;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponses
{
    public function response(string $message, int $status, array|Model|JsonResource|null $data = null)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data ?? []
        ], $status);
    }

    public function error(string $message, int $status = Response::HTTP_BAD_REQUEST, array|MessageBag|null $errors = null, array $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'errors' => $errors ?? [],
            'data' => $data
        ], $status);
    }
}