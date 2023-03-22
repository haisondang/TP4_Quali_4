<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use \Mockery\Adapter\Phpunit\MockeryTestCase;

require __DIR__ . '/../vendor/autoload.php';

class GestionEauServiceTest extends MockeryTestCase
{
    public function test_()
    {
        $this->assertSame(3, 2 + 2);
    }

}
