<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index(Request $request, $id){
        $fields = [];
        $subject = Subjects::query()->where('student_id','=',$id);

        if ($request->get('sort') && $request->get('direction')) {
            $subject->orderBy($request->get('sort'), $request->get('direction'));
        }
        if ($request->get('search')) {
            $subject->where('name', 'like', "{$request->get('search')}%")
                ->orWhere('instructor', 'like', "{$request->get('search')}%");
        }
        if ($request->get('limit')) {
            $subject->limit($request->get('limit'));
        }
        if ($request->get('offset')) {
            $subject->offset($request->get('offset'))->limit(PHP_INT_MAX);
        }
        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
        }
        if ($request->get('remarks')) {
            $result =[];
            $average = $subject->get('average');
            $average;
            foreach ($average as $key => $value) {
                if($average[$key]->average > 3.00){
                    $result[$key] = "FAILED";
                }
                else if($average[$key]->average <= 3.00){
                    $result[$key] = "PASSED";
                };
            }
            return $result;
        }
        return response()->json([$fields ? $subject->get($fields) : $subject->get(), 'greetings'=>'Get Test']);
    }
    public function create_subject(Request $request, $id){
        $newSubject = Subjects::create([
            'student_id'    => $id,
            'subject_code'  => $request->subject_code,
            'name'          => $request->name,
            'description'   => $request->description,
            'instructor'    => $request->instructor,
            'schedule'      => $request->schedule,
            'prelims'       => $request->prelims,
            'midterms'      => $request->midterms,
            'prefinals'     => $request->prefinals,
            'finals'        => $request->finals,
            'average'       => $request->average,
            'date_taken'    => $request->date_taken
        ]);
        $subject = Subjects::query();
        return response()->json([$subject->where('id', '=', $newSubject->id)->get(), 'message'=>'Post Test'], Response::HTTP_CREATED);
    }
    public function update_subject(Request $request, $id)
    {
        $subject = Subjects::query()->where('id','=', $id);
        $subject->update($request->all());
        return response()->json([$subject->get(), 'message'=>'Patch Test']);
    }
    public function subject($id, $subject_id)
    {
        $subject = Subjects::query()->where('student_id','=',$id)->where('id','=',$subject_id);
        return response()->json($subject->get());
    }
}
