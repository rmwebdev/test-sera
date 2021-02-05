<?php

use App\Models\Member;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_data_member_empty_in_member_table()
    {
        $response = $this->call('GET', '/members');

        $this->assertEquals(200, $response->status());
    
    }

    public function test_data_member_not_empty_in_member_table()
    {

        $member = Member::create([
            'name'=> 'Hendro kartiko',
            'phone'=>'1236678456',
            'email'=>'email@email.com',
            'address'=>'Jakarta Kramat Jati'
        ]);

        $response = $this->call('GET', '/members');

        $response->assertEquals(200);
        $response->seeJsonEquals($member->name);

    }
}
