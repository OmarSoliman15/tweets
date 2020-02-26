<?php

namespace Tests\Support\Traits;

trait GeneratesPassportKeys
{
    /** @before */
    public function registerGeneratePassportKeysCallback()
    {
        $this->afterApplicationCreated(function () {
            $this->artisan('passport:keys');
        });
    }
}
