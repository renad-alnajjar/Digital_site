<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currency = Currency::all();
        return view('cms.currencies.index', ['currency' => $currency]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cms.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(), [
            'name' => 'required|string|min:3',
            'currencyvalue' => 'required|string',
            'content' => 'required|string|min:3',
            'image' => 'required|image|max:2048|mimes:jpg,png',

        ]);
        if (!$validator->fails()) {
            $currency = new Currency();
            $currency->name = $request->input('name');
            $currency->currencyvalue = $request->input('currencyvalue');
            $currency->content = $request->input('content');

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $currency->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('currency', $imageName, ['disk' => 'public']);
                $currency->image = 'currency/' . $imageName;
            }
            $issaved = $currency->save();
            return response()->json(
                ['message' => $issaved ? 'currency created successfully' : 'currency created failed'],
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
    public function show(Currency $currency)
    {
        //
        $currency = Currency::where('id', $currency->id)->first();
        return response()->json(['data' => $currency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
        return response()->view('cms.currencies.update', [
            'currency' => $currency,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|min:3',
            'currencyvalue' => 'required|string',
            'content' => 'required|string|min:3',
            'image' => 'nullable|image|max:2048|mimes:jpg,png',



        ]);
        if (!$validator->fails()) {
            $currency->name = $request->input('name');
            $currency->currencyvalue = $request->input('currencyvalue');
            $currency->content = $request->input('content');
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . str_replace(' ', '', $currency->name) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('currency', $imageName, ['disk' => 'public']);
                $currency->image = 'currency/' . $imageName;
            }
            $issaved = $currency->save();
            return response()->json(
                ['message' => $issaved ? 'currency Update successfully' : 'currency Update failed'],
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
    public function destroy(Currency $currency)
    {
        //
        $deleted = $currency->delete();
        if ($deleted) {
            if ($currency->image !== Null) {
                Storage::disk('public')->delete($currency->image);
            }
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
