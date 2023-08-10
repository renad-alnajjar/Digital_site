<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Courses::all();
        return response()->view('cms.courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cms.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'SubTitle' => 'required|string|min:3',
            'href' => 'required|url|min:3',
            'name' => 'required|string|min:3',
            'price' => 'required|string',
            'content' => 'required|string|min:3',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);
        if (!$validator->fails()) {
            $courses = new Courses();
            $courses->name = $request->input('name');
            $courses->SubTitle = $request->input('SubTitle');
            $courses->href = $request->input('href');
            $courses->price = $request->input('price');
            $courses->content = $request->input('content');

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $courses->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('courses', $imageName, ['disk' => 'public']);
                $courses->image = 'courses/' . $imageName;
            }
            $issaved = $courses->save();
            return response()->json(
                ['message' => $issaved ? 'courses created successfully' : 'courses created failed'],
                $issaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST

            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $course)
    {
        //

        return response()->view('cms.courses.update', [
            'course' => $course,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $courses)
    {
        //
        $validator = validator($request->all(), [
            'SubTitle' => 'required|string|min:3',
            'name' => 'required|string|min:3',
            'price' => 'required|string',
            'content' => 'required|string|min:3',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);
        if (!$validator->fails()) {
            $courses->name = $request->input('name');
            $courses->SubTitle = $request->input('SubTitle');
            $courses->price = $request->input('price');
            $courses->content = $request->input('content');

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $courses->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('courses', $imageName, ['disk' => 'public']);
                $courses->image = 'courses/' . $imageName;
            }
            $issaved = $courses->save();
            return response()->json(
                ['message' => $issaved ? 'courses created successfully' : 'courses created failed'],
                $issaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST

            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $course)
    {
        //

        $deleted = $course->delete();
        if ($deleted) {
            if ($course->image !== Null) {
                Storage::disk('public')->delete($course->image);
            }
            if ($course->video !== Null) {
                Storage::disk('public')->delete($course->video);
            }
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
