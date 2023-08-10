<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RegesterUserController extends Controller
{
    //

    public function showPageCreateUser()
    {
        $roles = Role::where('guard_name', 'user')->get();
        $cities = Currency::all();
        return response()->view('cms.CreateNewUser.create', [
            'roles' => $roles,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|numeric|exists:roles,id',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'age' => 'required|string|max:2',
            'gender' => 'required|string|in:M,F',
            'phoneNumper' => 'required|string|min:10',
            'image' => 'required|image|max:2048|mimes:jpg,png'
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->age = $request->input('age');
            $user->gender = $request->input('gender');
            $user->phone = $request->input('phoneNumper');
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $user->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('user', $imageName, ['disk' => 'public']);
                $user->image = 'user/' . $imageName;
            }
            $isSaved = $user->save();
            if ($isSaved) {
                $user->assignRole(Role::findOrFail($request->input('role_id')));
            }
            return Response()->json(

                ['message' => $isSaved ? 'created successfully' : 'created failed!'],

                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        };
    }
}
