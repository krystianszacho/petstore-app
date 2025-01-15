<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PetService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://petstore.swagger.io/v2/',
            'timeout' => 5.0,
        ]);
    }

    public function getAllPets($status = 'available')
    {
        try {
            $response = $this->client->get('pet/findByStatus', [
                'query' => ['status' => $status],
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => 'API request failed: ' . $e->getMessage()];
        }
    }

    public function addPet($data)
    {
        try {
            $response = $this->client->post('pet', [
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => 'API request failed: ' . $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response'
            ];
        }
    }

    public function updatePet($data)
    {
        try {
            $response = $this->client->put('pet', [
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => 'API request failed: ' . $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response'
            ];
        }
    }

    public function deletePet($id)
    {
        try {
            $response = $this->client->delete("pet/{$id}");
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => 'API request failed: ' . $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response'
            ];
        }
    }

    public function getPetById($id)
    {
        try {
            $response = $this->client->get("pet/{$id}");
            $data = json_decode($response->getBody(), true);

            if (isset($data['id'])) {
                return $data;
            }

            return ['error' => 'Pet not found or invalid response'];
        } catch (RequestException $e) {
            return ['error' => 'API request failed: ' . $e->getMessage()];
        }
    }
}
