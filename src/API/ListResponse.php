<?php

namespace App\API;

use App\Entity\InstaPost;
use App\Transformer\InstaPostTransformer;
use JsonSerializable;

class ListResponse implements JsonSerializable
{

    /**
     * ListResponse constructor.
     * @param InstaPost[] $items
     * @param string|null $maxId
     * @param int|null $timestamp
     */
    public function __construct(
        $items,
        string $maxId = null,
        int $timestamp = null
    ) {
        $this->setItems($items);
        $this->setMaxId($maxId);
        $this->setTimestamp(($timestamp) ? $timestamp : time());
    }

    /**
     * @var InstaPost[]
     */
    private $items;

    /**
     * @var string|null
     */
    private $maxId = null;

    /**
     * @var int
     */
    private $timestamp;

    /**
     * @return InstaPost[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param InstaPost[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return string|null
     */
    public function getMaxId(): ?string
    {
        return $this->maxId;
    }

    /**
     * @param string|null $maxId
     */
    public function setMaxId(?string $maxId): void
    {
        $this->maxId = $maxId;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @param InstaPostTransformer $itemPostTransformer
     */
    public function setItemPostTransformer(InstaPostTransformer $itemPostTransformer): void
    {
        $this->itemPostTransformer = $itemPostTransformer;
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
        $items = [];

        foreach ($this->getItems() as $item) {
            $items[] = $item->jsonSerialize();
        }

        return [
            'status' => StatusCode::SUCCESS,
            'items' => $items,
            'nextPage' => $this->getMaxId(),
            'timestamp' => $this->getTimestamp()
        ];
    }
}