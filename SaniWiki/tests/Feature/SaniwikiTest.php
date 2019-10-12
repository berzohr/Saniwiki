<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaniwikiTest extends TestCase
{

    // Get 200 status from root
    public function testGetRoot()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Get Found status from /home
    public function testGetHome()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }

    // Get a list of sections by a category id
    public function testGetSectionsByCategoryId() {
        $response = $this->json('GET', '/api/sections/1');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                    'id',
                    'name',
                    'category',
                    'iconFontAw',
                    'iconURL',
                    'isIconURL',
                    'created_at',
                    'updated_at'
                ]
            ]
        );
    }

}
