<?php
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\DatabaseMigrations;

class CourseTest extends TestCase 
{
    use DatabaseMigrations;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCanCreateCourse()
    {
        
        $response = $this->call('POST', '/course', [
            'name' => 'Kursur PHP Advance',
            'level' => 'Beginner',
            'benefit' => 'Bisa membuat website sendiri'
            ]);
            $this->assertEquals(201, $response->status());
    }
    public function testCanUpdateCourse()
    {
        
        $response = $this->call('PUT', '/course/1', [
            'name' => 'Laravel Eloquent Master',
            'level' => 'Master',
            'benefit' => 'Bisa membuat website sendiri'
            ]);
            $this->assertEquals(202, $response->status());
    }

    public function testCanDeleteCourse()
    {
        
        $response = $this->call('DELETE', '/course/1');
            $this->assertEquals(200, $response->status());
    }

}