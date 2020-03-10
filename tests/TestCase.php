<?php

namespace Tests;

use App\Models\Comment;
use App\Traits\HasLikes;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertClassUsesTrait($trait, $class){
        $this->assertArrayHasKey($trait, class_uses($class), "{$class} must be use {$trait} trait");
    }

}
