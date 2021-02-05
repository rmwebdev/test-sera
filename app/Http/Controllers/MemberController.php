<?php

namespace App\Http\Controllers;


use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('time', 'desc')->get();

        $response = [
            'message' => 'List member order by time',
            'data' => $members
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' =>$request->address,
            ];
            $member = Member::create($data);

            $response = [
                'message'=> 'Member created',
                'data' => $member
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            
            $response = [
                'message'=> 'Failed ' . $e->errorInfo,
            ];
        }
    }

    public function show($id)
    {
        
        try {
            $member = Member::findOrFail($id);

            if(is_null($member->_id)){

                $response = [
                    'message'=> 'Member not found'
                ];
                return response()->json($response, Response::HTTP_NOT_FOUND);
            }

            $response = [
                'message'=> 'Member detail',
                'data' => $member
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (\Throwable $th) {

            $response = [
                'message'=> 'Member not found'
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    
    }

    public function update(Request $request, $id)
    {
        try {
            $members = Member::findOrFail($id);
            
            $validator = $this->validator($request);

            if($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
                try {
                    $data = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' =>$request->address,
                    ];
    
                    $members = Member::where('_id',$id)->update($data);
    
                    $user = Member::findOrFail($id);
                    $response = [
                        'message'=> 'Member updated',
                        'data' => $user
                    ];
                    return response()->json($response, Response::HTTP_CREATED);
                } catch (\Exception $e) {
                    $response = [
                        'message'=> 'Failed ' . $e->errorInfo,
                    ];
                }
        }catch (\Throwable $th) {
    
            $response = [
                'message'=> 'Member not found'
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
            }
    
    }
    public function destroy($id)
    {
        try {

            $member = Member::findOrFail($id);

            try {
    
            $member->delete();
            $response = [
                'message'=> 'Member deleted'
            ];
    
            return response()->json($response, Response::HTTP_OK);
            } catch (\Exception $e) {
                    
                $response = [
                    'message'=> 'Failed ' . $e->errorInfo
                ];
            }
    
        
        } catch (\Throwable $th) {

            $response = [
                'message'=> 'Member not found'
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
        
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:members',
            'phone' => 'required|min:8',
            'address' => 'required|min:8',
        ]);

    }
}
