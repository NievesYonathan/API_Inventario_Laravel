<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalidaTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_crear_salida()
    {
        $response = $this->postJson('/api/salidas', [
            'producto_id' => 1,
            'fecha_salida' => '2024-11-06',
            'motivo' => 'Prueba al fallo',
            'cantidad' => 100,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'status' => 201,
            ]);
    }
}
