<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected function genResponse(array $results, $status = 200)
    {
      $response = [
            'success' => true,
            'data' => $results
        ];

        return response()->json($response, $status);
    }
    protected function genError($message)
    {
        $response = [
            'success' => false,
            'message'=> 'Failed ' . $message
        ];
         return response()->json($response, Response::HTTP_EXPECTATION_FAILED);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

}
