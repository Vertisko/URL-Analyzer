<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GzipEncodingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->executeTest('google.sk', true);
        $this->executeTest('https://reinto.cz', false);
        $this->executeTest('https://www.reddit.com', true);
    }

    private function executeTest(string $url, bool $isSupported)
    {
        $response = $this->json('GET', "/api/gzip?url=$url");
        $response->assertStatus(200);
        $response->assertJson(["isSupported" => $isSupported]);
    }
}
