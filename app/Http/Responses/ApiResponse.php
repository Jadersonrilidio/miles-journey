<?php

namespace App\Http\Responses;

use App\Enums\ResponseStatus;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse implements Responsable
{
    /**
     * 
     */
    private function __construct(
        private int $httpCode,
        private ?ResponseStatus $status,
        private ?string $message,
        private mixed $data,
        private array $headers = [],
    ) {
        //
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return response()->json(
            data: $this->payload(),
            status: $this->httpCode,
            headers: $this->headers,
            options: JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * Return a payload as array that may contain keys 'data', 'status' and 'message' if set.
     * 
     * @return array
     */
    private function payload(): array
    {
        $payload = [];

        if ($this->status && $this->status instanceof ResponseStatus) {
            $payload['status'] = $this->status->value;
        }

        if ($this->message && is_string($this->message)) {
            $payload['message'] = $this->message;
        }

        if ($this->data && !empty($this->data)) {
            $payload['data'] = $this->data;
        }

        return $payload;
    }

    /**
     * 
     */
    public static function ok(mixed $data = null, string $message = null): static
    {
        return new static(Response::HTTP_OK, ResponseStatus::Success, $message, $data);
    }

    /**
     * 
     */
    public static function created(mixed $data = null, string $message = 'resource created'): static
    {
        return new static(Response::HTTP_CREATED, ResponseStatus::Success, $message, $data);
    }

    /**
     * 
     */
    public static function badRequest(mixed $data = null, string $message = 'something went wrong'): static
    {
        return new static(Response::HTTP_BAD_REQUEST, ResponseStatus::Error, $message, $data);
    }

    /**
     * 
     */
    public static function notFound(mixed $data = null, string $message = 'resource not found'): static
    {
        return new static(Response::HTTP_NOT_FOUND, ResponseStatus::Error, $message, $data);
    }

    /**
     * 
     */
    public static function unauthorized(mixed $data = null, string $message = 'unauthorized'): static
    {
        return new static(Response::HTTP_UNAUTHORIZED, ResponseStatus::Error, $message, $data);
    }

    /**
     * 
     */
    public static function forbidden(mixed $data = null, string $message = 'forbidden'): static
    {
        return new static(Response::HTTP_FORBIDDEN, ResponseStatus::Error, $message, $data);
    }
}
