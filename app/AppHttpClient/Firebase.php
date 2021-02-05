<?php


namespace App\AppHttpClient;
use GuzzleHttp\Client;


class Firebase 
{

    protected $client;
    protected $table;

    public function __construct( string $table)
    {
    
        $this->table = $table;
    
        $this->client = new Client([
            'base_uri' => env('FIREBASE_URI')]);
    }

    private function response($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCourses()
    {
        return $this->response($this->client->request('GET', $this->table));    
    }

    public function createCourse(array $postData)
    {
        return $this->response($this->client->request('POST', 'courses.json', ['json' => $postData]));
    }

    public function getCourse(string $id)
    {
        return $this->response($this->client->request('GET', $this->table . '/' . $id . '.json'));
    }

    public function updateCourse(string $id, array $postData)
    {
        return $this->response($this->client->request('PUT', $this->table . '/' . $id . '.json', ['json' => $postData]));
    }

    public function deleteCourse(string $id)
    {
        return $this->response($this->client->request('DELETE', $this->table . '/' . $id . '.json'));
    }

}