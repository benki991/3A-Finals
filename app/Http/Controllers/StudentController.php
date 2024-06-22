<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $fields = [];
        $students = Students::query();

        if ($request->get('sort') && $request->get('direction')) {
            $students->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('search')) {
            $students->where('firstname', 'like', "{$request->get('search')}%")
                ->orWhere('lastname', 'like', "{$request->get('search')}%");
        }

        if ($request->get('limit')) {
            $students->limit($request->get('limit'));
        }

        if ($request->get('offset')) {
            $students->offset($request->get('offset'))->limit(PHP_INT_MAX);
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
        }

        if ($request->get('year')) {
            $students->where('year', $request->get('year'));
        }

        if ($request->get('course')) {
            $students->where('course', $request->get('course'));
        }

        if ($request->get('section')) {
            $students->where('section', $request->get('section'));
        }

        return response()->json([$fields ? $students->get($fields) : $students->get(), 'greetings'=>'hello']);
    }

    public function student($id)
    {
        $students = Students::query()->where('id', '=', $id);
        return response()->json($students->get());
    }

    public function create(Request $request)
    {
        $newStudent = Students::create([
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'birthdate'     => $request->birthdate,
            'sex'           => $request->sex,
            'address'       => $request->address,
            'year'          => $request->year,
            'course'        => $request->course,
            'section'       => $request->section,
        ]);
        $student = Students::query();
        return response()->json([$student->where('id', '=', $newStudent->id)->get(), 'message'=>'Post Test'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $student = Students::query()->where('id','=', $id);
        $student->update($request->all());
        return response()->json([$student->get(), 'message'=>'Patch Test'], Response::HTTP_OK);
    }
}

