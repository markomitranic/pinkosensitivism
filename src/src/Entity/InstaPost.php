<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstaPostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class InstaPost implements JsonSerializable
{

    const TYPE_VIDEO = "video";
    const TYPE_IMAGE = "image";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=120)
     */
    private $instagramId;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=64, columnDefinition="enum('video', 'image')")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=1200, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=1200)
     * @var string
     */
    private $thumbnail;

    /**
     * @var string
     */
    private $thumbnailUrl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likeCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commentCount;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInstagramId(): string
    {
        return $this->instagramId;
    }

    /**
     * @param string $instagramId
     */
    public function setInstagramId(string $instagramId): void
    {
        $this->instagramId = $instagramId;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     */
    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
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

    public function getLikeCount(): ?int
    {
        return $this->likeCount;
    }

    public function setLikeCount(?int $likeCount): self
    {
        $this->likeCount = $likeCount;

        return $this;
    }

    public function getCommentCount(): ?int
    {
        return $this->commentCount;
    }

    public function setCommentCount(?int $commentCount): self
    {
        $this->commentCount = $commentCount;

        return $this;
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
            'thumbnailUrl' => $this->getThumbnail(),
            'likeCount' => $this->getLikeCount(),
            'commentCount' => $this->getCommentCount(),
            'dateTime' => $this->getDateTime()
        ];
        return $json;
    }

}
