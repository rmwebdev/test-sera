<?php

namespace App\Http\Controllers;

use App\AppHttpClient\Firebase;
use Illuminate\Http\Request;

class FirebaseCrudController extends Controller
{
    
    public function index(Request $request)
    {
        $client = new Firebase('courses.json');
        try {
            
            $result = $client->getCourses();

        if($result == null){
            return $this->genResponse(['success' => true, 'message' => 'No data in database!']);
        }

           return $this->genResponse($result);

        } catch (\Exception $e) {
            return $this->genError($e->errorInfo);
        }
    }

    public function store(Request $request)
    {

        $client = new Firebase('courses.json');
        try {
            
            $result = $client->createCourse([
                    'name' => $request->input('name'),
                    'level' => $request->input('level'),
                    'benefit' => $request->input('benefit')
                ]);

            return $this->genResponse($result, 201);

        } catch (\Exception $e) {

            return $this->genError($e->errorInfo);
        }
    }

    public function show(Request $request)
    {
        $client = new Firebase('courses');
        try {
            
            $id = $request->route('id');
            $result = $client->getCourse($id);
           return $this->genResponse($result);

        } catch (\Exception $e) {
            return $this->genError($e->errorInfo);
        }
    }


    public function update(Request $request)
    {

        $client = new Firebase('courses');
        try {
            
            $id = $request->route('id');

            $result = $client->updateCourse($id,
                [
                    'name' => $request->input('name'),
                    'level' => $request->input('level'),
                    'benefit' => $request->input('benefit')
                ]);

            return $this->genResponse($result, 202);

        } catch (\Exception $e) {

            return $this->genError($e->errorInfo);
        }
    }
    public function destroy(Request $request)
    {
        $client = new Firebase('courses');
        try {
            
            $id = $request->route('id');
            $result = $client->deleteCourse($id);

           return $this->genResponse(['success' => true, 'message' => 'Data successfully deleted!']);

        } catch (\Exception $e) {
            return $this->genError($e->errorInfo);
        }
    }

}
