<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class IntegrasiController extends Controller
{

    public function __construct()
    {

        $this->integrasi = env('INTEGRASI_URI');
        $this->dataObject = config('objectData.status');

        $this->data = config('data.json');

    }
    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $url = $this->integrasi .'register';
            
            $client = new Client([
                    'headers'       => ['Content-type' => 'application/json']
                ]);

            $json = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $response = $client->post($url,  
            ['json' => $json]);
            
           $res = $response->getBody()->getContents();

        return response()->json(['success' => true, 'message' => 'Data successfuly register!'], Response::HTTP_OK);
            
        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'message' => substr($th->getMessage(), 0, 50)], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        try {
            $url = $this->integrasi .'login';
            $client = new Client([
                    'headers'       => ['Content-type' => 'application/json']
                ]);
            $email = 'eve.holt@reqres.in';
            $password = 'cityslicka';

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $json = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            if($json['email'] != $email || $json['password'] != $password){
                return response()->json(['success' => false, 'message' => 'Email or password incorrect!'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $response = $client->post($url,  
            ['json' => $json]);
            
           $res = $response->getBody()->getContents();
            return response()->json(['success' => true, 'message' => 'Data successfuly login!', 'data' => json_decode($res, true)], Response::HTTP_OK);
            
        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'message' => substr($th->getMessage(), 0, 50)], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function filter()
    {
        $path = base_path() . '/data.json'; 

        $json = json_decode(file_get_contents($path), true);
        
        $object =  $json['data']['response']['billdetails'];


      return $object;

        // return array_filter($object['body']->DENOM )
       
        
    }

    

}
