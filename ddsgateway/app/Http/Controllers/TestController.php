<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function testSite1()
    {
        try {
            $client = new Client();
            $response = $client->get('http://localhost:8000/api/users');
            return response()->json([
                'success' => true,
                'data' => json_decode($response->getBody(), true)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'type' => get_class($e)
            ]);
        }
    }

    public function testSite2()
    {
        try {
            $client = new Client();
            $response = $client->get('http://localhost:8001/api/users');
            return response()->json([
                'success' => true,
                'data' => json_decode($response->getBody(), true)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'type' => get_class($e)
            ]);
        }
    }
}