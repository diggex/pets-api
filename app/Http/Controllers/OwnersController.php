<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resources\Pets\Owners;

class OwnersController extends Controller
{
    private $ownersObj;

    public function __construct(Owners $ownersObj)
    {
        $this->ownersObj = $ownersObj;
    }

    /**
     * Display a listing of the owners.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownersJson = $this->ownersObj->handler();


        if (false === $ownersJson) {
            return response()->json([
               'error' => 'Data source error'
            ], 500);
        }

        $owners = json_decode($ownersJson, true);

        if (!is_array($owners)) {
            return response()->json([
               'error' => 'Resource not found'
            ], 404);
        }

        foreach ($owners as $key => $value) {
            if (is_array($value["pets"])) {
                foreach ($value["pets"] as $k => $v) {
                    if ("cat" == strtolower($v["type"])) {
                        $result["data"][strtolower($value["gender"])][] = $value["name"];
                        break;
                    }
                }
            }
        }

        $result["data"]["male"] = $result["data"]["male"] ?? [];
        $result["data"]["female"] = $result["data"]["female"] ?? [];

        sort($result["data"]["male"]);
        sort($result["data"]["female"]);

        return response()->json($result, 200);
    }
}
