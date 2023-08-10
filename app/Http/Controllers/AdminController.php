<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Admin::all();
        return response()->view('cms.admins.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(), [
            // 'role_id' => 'required|numeric|exists:roles,id',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|string|min:10',
            'image' => 'required|image|max:2048|mimes:jpg,png',
            'password' => 'required|string',

        ]);
        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->phone = $request->input('phone');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $admin->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('admin', $imageName, ['disk' => 'public']);
                $admin->image = 'admin/' . $imageName;
            }
            $issaved = $admin->save();
            return response()->json(
                ['message' => $issaved ? 'Admin created successfully' : 'Admin created failed'],
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
        return response()->view('cms.admins.update', [
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $validator = validator($request->all(), [
            // 'role_id' => 'required|numeric|exists:roles,id',

            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'image' => 'nullable', 'image|max:2048|mimes:jpg,png',

        ]);
        if (!$validator->fails()) {
            $admin->name = $request->input('name');
            $admin->phone = $request->input('phone');
            $admin->email = $request->input('email');
            // $admin->city_id = $request->input('cities');
            if ($request->hasFile('image')) {
                if ($admin->image !== Null) {
                    Storage::disk('public')->delete($admin->image);
                }
                $imageName = time() . '_' . str_replace(' ', '', $admin->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('admin', $imageName, ['disk' => 'public']);
                $admin->image = 'admin/' . $imageName;
            }
            $issaved = $admin->save();
            // if ($issaved) $admin->syncRoles(Role::findOrFail($request->input('role_id')));

            return response()->json(
                ['message' => $issaved ? 'Admin Update successfully' : 'Admin Update failed'],
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
    public function destroy(Admin $admin)
    {
        //
    }
}
