<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_subjects()
    {
        $response = $this->get('/api/students/1/subjects');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonPath('greetings','Get Test');
    }
    public function test_post_subjects(){
        $response = $this->post('/api/students/1/subjects',[
            'student_id'=>1,
            'subject_code'=>1234,
            'name'=>'DBMS',
            'description'=>'Post Test Post Test Post Test',
            'instructor'=>'Kevin',
            'schedule'=>'MW 1pm-3pm',
            'prelims'=>1.5,
            'midterms'=>1.5,
            'prefinals'=>1.5,
            'finals'=>1.5,
            'date_taken'=>'2024-06-22'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message','Post Test');
    }
    public function test_patch_subjects(){
        $response = $this->patch('/api/students/1/subjects/1',[
            'student_id'=>1,
            'subject_code'=>1234,
            'name'=>'DBMS',
            'description'=>'Post Test Post Test Post Test',
            'instructor'=>'Benki',
            'schedule'=>'MW 1pm-3pm',
            'prelims'=>1.5,
            'midterms'=>1.5,
            'prefinals'=>1.5,
            'finals'=>1.5,
            'date_taken'=>'2024-06-22'
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message','Patch Test');
    }
}
