<?php

namespace Tests\Feature\Api;

use Tests\TestCase as BaseTestCase;
use Tests\Support\Traits\GeneratesPassportKeys;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends BaseTestCase
{
    use RefreshDatabase, GeneratesPassportKeys;
}
