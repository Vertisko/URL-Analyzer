<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpTest extends TestCase
{
    // LITTLE INTRODUCTION
    // tests result were compared against web tool https://tools.keycdn.com/http2-test
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->executeTest('google.sk', true);
        $this->executeTest('https://google.sk', true);
        $this->executeTest('https://2ice.tech', true);
        $this->executeTest('https://reinto.cz', false);
        $this->executeTest('http://www.reinto.cz', false);
        $this->executeTest('http://google.sk', true);
        $this->executeTest('https://www.reddit.com', true);
    }

    private function executeTest(string $url, bool $isSupported)
    {
        $response = $this->json('GET', "/api/http?url=$url");
        $response->assertStatus(200);
        $response->assertJson(["isSupported" => $isSupported]);
    }
}
