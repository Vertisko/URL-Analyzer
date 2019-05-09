<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MissingAltsTest extends TestCase
{
    // LITTLE INTRODUCTION
    // tests result were compared against content received in POSTMAN TOOL
    // every image is counted even hidden one
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->executeTest('http://www.reinto.cz/adwa', ['with' => 0, 'without' => 0]);
        $this->executeTest('http://www.reinto.cz/', ['with' => 4, "without"=> 71]);
        $this->executeTest('google.sk', ['with' => 1, "without" => 1]);
    }

    private function executeTest(string $url, array $json)
    {
        $response = $this->json('GET', "/api/image-alt?url=$url");
        $response->assertStatus(200);
        $response->assertJson($json);
    }
}
