<?php

namespace Tests\Support;

use Exception;
use Tests\Support\Contracts\ResourceStracture;

class Structure
{
    /**
     * List of registered structures.
     *
     * @var array
     */
    protected static $registeredStructures = [
        \App\User::class => \Tests\Support\Structures\UserStructure::class,
    ];

    /**
     * Display the given structure array.
     *
     * @param  string  $name
     * @param  array  $additionalData
     * @return array
     * @throws \Exception
     */
    public static function make($name, $additionalData = [])
    {
        if (! isset(static::$registeredStructures[$name])) {
            throw new Exception("The there is no registered structure for \"{$name}\"!");
        }

        $structure = static::$registeredStructures[$name];
        $structureInstance = new $structure;

        if (! $structureInstance instanceof ResourceStracture) {
            throw new Exception("The \"{$structure}\" should implements \Tests\Support\Contracts\ResourceStracture");
        }

        return $structureInstance->data($additionalData);
    }
}
