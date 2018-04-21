<?php

namespace App\Entity;

use JsonSerializable;

class InstaPost implements JsonSerializable
{

    const TYPE_VIDEO = "video";
    const TYPE_IMAGE = "image";

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type = "image";

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $thumbnailUrl;

    /**
     * @var string|null
     */
    private $videoUrl = null;

    /**
     * @var int
     */
    private $likeCount = 0;

    /**
     * @var int
     */
    private $commentCount = 0;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     */
    public function setThumbnailUrl(string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return null|string
     */
    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    /**
     * @param null|string $videoUrl
     */
    public function setVideoUrl(?string $videoUrl): void
    {
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    /**
     * @param int $likeCount
     */
    public function setLikeCount(int $likeCount): void
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return int
     */
    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    /**
     * @param int $commentCount
     */
    public function setCommentCount(int $commentCount): void
    {
        $this->commentCount = $commentCount;
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
        $json = [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'link' => $this->getLink(),
            'thumbnailUrl' => $this->getThumbnailUrl(),
            'likeCount' => $this->getLikeCount(),
            'commentCount' => $this->getCommentCount()
        ];

        if ($this->getType() === self::TYPE_VIDEO) {
            $json['videoUrl'] = $this->getVideoUrl();
        }

        return $json;
    }
}
