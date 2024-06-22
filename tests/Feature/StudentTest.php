<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_student()
    {
        $response = $this->get('/api/students');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonPath('greetings','hello');
    }
    public function test_post_student(){
        $response = $this->post('/api/students', [
            'firstname'=>'benki',
            'lastname'=>'kevin',
            'birthdate'=>'2002-12-13',
            'sex'=>'MALE',
            'address'=>'Tacloban',
            'year'=>3,
            'course'=>'BSIT',
            'section'=>'A'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message','Post Test');
    }
    public function test_patch_student(){
        $response = $this->patch('/api/students/1',[
            'firstname'=>'kevin',
            'lastname'=>'benki',
            'birthdate'=>'2002-12-13',
            'sex'=>'MALE',
            'address'=>'Tacloban',
            'year'=>3,
            'course'=>'BSIT',
            'section'=>'A'
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message','Patch Test');
    }
}
