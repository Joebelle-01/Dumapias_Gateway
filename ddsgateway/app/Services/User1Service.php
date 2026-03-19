<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        // HARDCODED VALUES - This WILL work
        $this->baseUri = 'http://localhost:8000/api/';
        $this->secret = 'TwztTuzhKh4t6rX4rYAdX4fK9r6Tfhur';
        
        // For debugging
        error_log("User1Service - Using hardcoded baseUri: " . $this->baseUri);
    }

    public function obtainUsers1()
    {
        try {
            $response = $this->performRequest('GET', 'users');
            
            // Decode and extract the data
            $data = json_decode($response, true);
            
            if (is_array($data) && isset($data['data'])) {
                return json_encode($data['data']);
            }
            
            return $response;
            
        } catch (\Exception $e) {
            error_log("User1Service error: " . $e->getMessage());
            throw $e;
        }
    }

    public function createUser1($data)
    {
        $response = $this->performRequest('POST', 'users', $data);
        return $this->extractData($response);
    }

    public function obtainUser1($id)
    {
        $response = $this->performRequest('GET', "users/{$id}");
        return $this->extractData($response);
    }

    public function editUser1($data, $id)
    {
        $response = $this->performRequest('PUT', "users/{$id}", $data);
        return $this->extractData($response);
    }

    public function deleteUser1($id)
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