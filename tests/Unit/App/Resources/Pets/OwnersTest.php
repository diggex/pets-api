<?php

namespace Tests\Unit\App\Resources\Pets;

use Tests\TestCase;
use PHPUnit\Framework\DOMTestCase;
use App\Resources\Pets\Owners;
use Illuminate\Http\Request;

class OwnersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     *
     * handler function test
     *
     * @return void
     */
    public function testHandler()
    {
        $owners = new Owners();

        $res = $owners->handler();

        $this->assertJson($res);
    }

   /**
     *
     * handler function test request fail
     *
     * @return void
     */
    public function testError()
    {

        $owners = new Owners();

        $owners->setUri('foo');

        $res = $owners->handler();

        $this->assertFalse($res);
    }
}
