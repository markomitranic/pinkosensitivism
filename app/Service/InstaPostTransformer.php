<?php

namespace Service;

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
            'link' => $post->getLink(),
            'id' => $post->getId()
        ];
    }

    /**
     * @param array $post
     * @return InstaPost
     */
    public function hydrate($post) {
        return new InstaPost($post);
    }

    /**
     * @param array $array
     * @return InstaPost[]
     */
    public function arrayToPosts(array $array)
    {
        /** @var InstaPost[] $posts */
        $posts = [];

        foreach ($array as $post) {
            array_push($posts, new InstaPost($post));
        }

        return $posts;
    }

    /**
     * @param InstaPost[] $posts
     * @return array
     */
    public function postsToArray($posts)
    {
        $array = [];

        /** @var InstaPost $post */
        foreach ($posts as $post) {
            array_push($array, $post->toArray());
        }

        return $array;
    }
}