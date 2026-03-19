<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        try {
            $client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => 30.0,
            ]);

            $response = $client->request($method, $requestUrl, [
                'form_params' => $form_params,
                'headers' => $headers
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return json_encode([
                'error' => $e->getMessage(),
                'base_uri' => $this->baseUri,
                'request_url' => $requestUrl
            ]);
        }
    }
}