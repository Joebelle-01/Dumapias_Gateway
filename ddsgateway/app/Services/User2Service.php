<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service
{
    use ConsumesExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = 'http://localhost:8001';
    }

    public function obtainUsers2()
    {
        // Add 'api' to the path
        return $this->performRequest('GET', '/api/users');
    }

    public function createUser2($data)
    {
        return $this->performRequest('POST', '/api/users', $data);
    }

    public function obtainUser2($id)
    {
        return $this->performRequest('GET', "/api/users/{$id}");
    }

    public function editUser2($data, $id)
    {
        return $this->performRequest('PUT', "/api/users/{$id}", $data);
    }

    public function deleteUser2($id)
    {
        return $this->performRequest('DELETE', "/api/users/{$id}");
    }
}