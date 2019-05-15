<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebPTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        //        <picture>
        //  <source srcset="img.webp" type="image/webp">
        //  <source srcset="img.jpg" type="image/jpeg">
        //  <img src="img.jpg">
        //</picture>
        $this->executeTest(
            '
        <source srcset="img.webp" type="image/webp">
        <source srcset="img.jpg" type="image/jpeg">',
            true
        );
        $this->executeTest(
            '<source srcset="img.jpg" type="image/jpeg">',
            false
        );
    }

    private function executeTest(string $body, bool $isSupported)
    {
        $response = $this->json('GET', "/api/webp?body=$body");
        $response->assertStatus(200);
        $response->assertJson(["isSupported" => $isSupported]);
    }
}
