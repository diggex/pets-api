<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Resources\Pets\Owners;

class OwnersTest extends TestCase
{
    protected $mock;

    public function mockOwnersObj($returnData)
    {
        $this->mock = $this->createMock(Owners::class);
        $this->mock->method('handler')
            ->willReturn($returnData);

        $this->app->instance(Owners::class, $this->mock);
    }

    /**
     * test normal situation
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->get('/api/owners');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'male',
                         'female',
                     ],
                 ]);
    }

    /**
     * test get data source fail situation
     *
     * @return void
     */
    public function testDataSourceFail()
    {

        $this->mockOwnersObj(false);
        $response = $this->get('/api/owners');
        $response->assertStatus(500)
                 ->assertJson(['error' => 'Data source error']);
    }

    /**
     * test api is empty situation
     *
     * @return void
     */
    public function testDataSourceEmpty()
    {

        $this->mockOwnersObj('');
        $response = $this->get('/api/owners');
        $response->assertStatus(404)
                 ->assertJson(['error' => 'Resource not found']);
    }
}
