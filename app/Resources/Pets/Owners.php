<?php

namespace App\Resources\Pets;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use App\Resources\Pets\Base;

class Owners extends Base
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = "/owners";
    }



    /**
     * get data.
     *
     * @return response
     */
    public function handler()
    {
        return $this->get();
    }
}
