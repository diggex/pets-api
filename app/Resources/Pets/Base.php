<?php

namespace App\Resources\Pets;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;

class Base
{
    protected $uri;

    protected $baseUri;

    protected $client;

    public function __construct()
    {

        $this->baseUri = config('pets.base_uri');

        $this->client = new Client(['base_uri' => $this->baseUri]);
    }

    /**
     * get data.
     *
     * @return response
     */
    public function setUri($uri)
    {

        if (null != $uri) {
            $this->uri = $uri;
        }

        return $uri;
    }

    /**
     * get data.
     *
     * @return response
     */
    public function get()
    {

        $uri = $this->uri;

        $options = [
            'verify' => false,
        ];


        try {
            $response = $this->client->request('GET', $uri, $options);

            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            return false;
        }
    }
}
