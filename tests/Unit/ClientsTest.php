<?php

namespace Tests\Unit;

use App\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ClientsTest extends TestCase
{
    /** @test */
    public function inputsClients()
    {
        Event::fake();

        $response = $this->post('clients', 
        [
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => '1',
            'entreprise_id' => '1'
        ]);

        $queryValidate = DB::table('clients')->select('name')->where('name', 'test')->get();

        $this->assertNotEmpty($queryValidate);
    }
}
