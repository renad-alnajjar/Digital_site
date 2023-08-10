<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();
        return response()->view('cms.user.index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cms.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            // 'role_id' => 'required|numeric|exists:roles,id',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'age' => 'required|string|max:2',
            'gender' => 'required|string|in:M,F',
            // 'city_id' => 'required|numeric|exists:cities,id',
            'phoneNumper' => 'required|string|min:10',
            'image' => 'required|image|max:2048|mimes:jpg,png'
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // $user->city_id = $request->input('city_id');
            $user->password = Hash::make('password');
            $user->age = $request->input('age');
            $user->gender = $request->input('gender');
            $user->phone = $request->input('phoneNumper');
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $user->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('user', $imageName, ['disk' => 'public']);
                $user->image = 'user/' . $imageName;
            }
            $isSaved = $user->save();
            // if ($isSaved) {
            //     $user->assignRole(Role::findOrFail($request->input('role_id')));
            // }
            return Response()->json(

                ['message' => $isSaved ? 'created successfully' : 'created failed!'],

                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $user = User::where('id', $user->id)->first();
        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return response()->view('cms.user.update', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //


        $validator = Validator($request->all(), [
            // 'role_id' => 'required|numeric|exists:roles,id',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'age' => 'required|string|max:2',
            'gender' => 'required|string|in:M,F',
            // 'city_id' => 'required|numeric|exists:cities,id',
            'phoneNumper' => 'required|string|min:10',
            'image' => 'required|image|max:2048|mimes:jpg,png'
        ]);
        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // $user->city_id = $request->input('city_id');
            // $user->password = Hash::make('password');
            $user->age = $request->input('age');
            $user->gender = $request->input('gender');
            $user->phone = $request->input('phoneNumper');
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $user->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('user', $imageName, ['disk' => 'public']);
                $user->image = 'user/' . $imageName;
            }
            $isSaved = $user->save();
            // if ($isSaved) {
            //     $user->assignRole(Role::findOrFail($request->input('role_id')));
            // }
            return Response()->json(

                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],

                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if ($deleted) {
            if ($user->image !== Null) {
                Storage::disk('public')->delete($user->image);
            }
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
