<?php

namespace Service;

use Exception;
use Model\InstaPost;

class InstaPostTransformer
{

    /**
     * @param InstaPost $post
     * @return array
     */
    public function transform(InstaPost $post) {
        return [
            'image' => $post->getImage(),
            'code' => $post->getCode(),
            'link' => $post->getLink(),
            'id' => $post->getId()
        ];
    }

    /**
     * @param array $post
     * @return InstaPost
     */
    public function hydrate($post) {
        return new InstaPost(
            $post['image'],
            $post['code'],
            $post['link'],
            $post['id']
        );
    }
}