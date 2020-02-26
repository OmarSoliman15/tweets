<?php

namespace Tests\Support\Structures;

use Tests\Support\Contracts\ResourceStracture;

class UserStructure implements ResourceStracture
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
            'name',
            'email',
            'date_of_birth',
            'age',
            'image'
        ];
    }
}
