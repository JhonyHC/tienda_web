<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaginaProducts extends TestCase
{
    /**
     * A basic feature test example.
     * Los test que se van a ejecutar deben empezar con test_
     * @return void
     */
    /* public function test_pagina_products()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    } */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeText(['Email','Password']);
    }

    /** @test */
    public function envio_formulario_login()
    {
        $response = $this->post('/products', [
            'nombre' => '',
            'correo' => 'correoNoValido',
            'mensaje' => 'asd',
        ]);
        $response->assertSessionHasErrors([
            'nombre',
            'correo',
            'mensaje',
        ]);
    }


}
