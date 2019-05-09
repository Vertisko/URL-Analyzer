<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusCodeTest extends TestCase
{
    // LITTLE INTRODUCTION
    // test results were compared against https://httpstatus.io status code
    // the object is to follow possible redirection and return final status code

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->executeTest('http://www.reinto.cz/adwa', 404);
        $this->executeTest('http://www.reinto.cz/', 200);
        $this->executeTest('google.sk', 200);
        $this->executeTest('https://stackoverflow.com/questions/1', 404);
        $this->executeTest('http://google.abc', 0);
    }

    private function executeTest(string $url, int $expectedStatus)
    {
        $response = $this->json('GET', "/api/curl/body?url=$url");
        $response->assertStatus(200);
        $response->assertJson(['statusCode' => $expectedStatus]);
    }
}
