<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoadsRoute extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $this->assertTrue(true);
        $data = [];
        $this->post(route('setup-mandatedddd'), $data)
        ->assertStatus(201)
        ->assertJson($data);


    }
}
