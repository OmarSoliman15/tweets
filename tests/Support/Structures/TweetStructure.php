<?php

namespace Tests\Support\Structures;

use Tests\Support\Contracts\ResourceStracture;

class TweetStructure implements ResourceStracture
{
    /**
     * The resource data structure.
     *
     * @return array
     */
    public function data()
    {
        return [
            'id',
            'body',
            'user',
            'created_at'
        ];
    }
}
