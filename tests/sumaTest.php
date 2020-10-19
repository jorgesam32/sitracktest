<?php

use TestCase;
use GuzzleHttp\Client;

class sumaTest extends TestCase
{

    public function test_Suma_json_invalido(){
        $jsn=[
            12
        ];

        $response=$this->post(route('suma'),$jsn);
        $response->assertResponseStatus(203);
    }
    public function test_Suma_json_valido_A_no_es_array(){
        $userData = [
            'A' => 1,
            'X' => 2
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
    public function test_Suma_json_valido_datos_validos(){
        $userData = [
            'A' =>[0 => 1, 1 => 2],
            'X' => 2
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
    public function test_Suma_json_valido_x_no_es_numero(){
        $userData = [
            'A' =>[0 => 1, 1 => 2],
            'X' => 'L'
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
    public function test_Suma_json_valido_A_fuera_de_rango(){
        $userData = [
            'A' =>[0 => -2001, 1 => 2],
            'X' => 5
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
    public function test_Suma_json_valido_no_entero_en_arreglo(){
        $userData = [
            'A' =>[0 => 'L', 1 => 2],
            'X' => 5
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
    public function test_Suma_json_valido_con_resultado(){
        $userData = [
            'A' =>[0 => 1, 1 => 2],
            'X' => 3
        ];

        $response=$this->json('POST', 'suma', $userData, ['Accept' => 'application/json']);
        $response->assertResponseStatus(203);

    }
}
