<?php

namespace App\API;

use JsonSerializable;

class ErrorResponse implements JsonSerializable
{

    /**
     * ErrorResponse constructor.
     * @param string $message
     * @param string|null $detail
     * @param int $errorCode
     */
    public function __construct(
        string $message,
        string $detail = null,
        int $errorCode = 400
    ) {
        $this->setMessage($message);
        $this->setDetail($detail);
        $this->setErrorCode($errorCode);
    }

    /**
     * @var string
     */
    private $message;

    /**
     * @var string|null
     */
    private $detail;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function getDetail(): ?string
    {
        return $this->detail;
    }

    /**
     * @param null|string $detail
     */
    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode(int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'status' => StatusCode::GENERAL_ERROR,
            'message' => $this->getMessage(),
            'detail' => $this->getDetail(),
            'code' => $this->getErrorCode()
        ];
    }
}