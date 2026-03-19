<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        // HARDCODED VALUES for Site 2
        $this->baseUri = 'http://localhost:8001/api/';
        $this->secret = '86SGnpRfrMU6gGMH5Kxi9ytT3TAqkmYZ';
    }

    public function obtainUsers2()
    {
        $response = $this->performRequest('GET', 'users');
        $data = json_decode($response, true);
        
        if (is_array($data) && isset($data['data'])) {
            return json_encode($data['data']);
        }
        return $response;
    }

    public function createUser2($data)
    {
        $response = $this->performRequest('POST', 'users', $data);
        return $this->extractData($response);
    }

    public function obtainUser2($id)
    {
        $response = $this->performRequest('GET', "users/{$id}");
        return $this->extractData($response);
    }

    public function editUser2($data, $id)
    {
        $response = $this->performRequest('PUT', "users/{$id}", $data);
        return $this->extractData($response);
    }

    public function deleteUser2($id)
    {
        $response = $this->performRequest('DELETE', "users/{$id}");
        return $this->extractData($response);
    }

    private function extractData($response)
    {
        $data = json_decode($response, true);
        if (is_array($data) && isset($data['data'])) {
            return json_encode($data['data']);
        }
        return $response;
    }
}