<?php

namespace App\Http\Controllers;

use App\Models\deposit;
use App\Models\Deposit as ModelsDeposit;
use App\Models\UserDeposit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  Deposit::with('userDeposit')->get();
        return view('cms.deposits.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cms.deposits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'amount' => 'required|numeric',
            'accountnumber' => 'required|string|min:10|max:10',
        ]);
        if (!$validator->fails()) {
            $deposit = new deposit();
            $deposit->amount = $request->input('amount');
            $deposit->accountnumber = $request->input('accountnumber');
            $issaved = $deposit->save();
            if ($issaved) {
                $userdeposits = new UserDeposit();
                $userdeposits->user_id = auth()->user()->id;
                $userdeposits->deposit_id = $deposit->id;
                $issavedSave = $userdeposits->save();
            }
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
    public function show(deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(deposit $deposit)
    {
        //

        return response()->view('cms.deposits.update', [
            'deposit' => $deposit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, deposit $deposit)
    {
        //
        $validator = validator($request->all(), [
            'amount' => 'required|numeric',
            'accountnumber' => 'required|string|min:10|max:10',
            'TypeCurrencies' => 'required|enum:USDT,Bitcoin',
            'status' => 'required|enum:waiting,Accredited,canceled',
        ]);
        if (!$validator->fails()) {
            $deposit->amount = $request->input('amount');
            $deposit->accountnumber = $request->input('accountnumber');
            $deposit->TypeCurrencies = $request->input('TypeCurrencies');
            $deposit->status = $request->input('status');
            $issaved = $deposit->save();
            if ($issaved) {
                $userdeposits = new UserDeposit();
                $userdeposits->user_id = auth()->user()->id;
                $userdeposits->deposit_id = $deposit->id;
                $issavedSave = $userdeposits->save();
            }
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
     * Remove the specified resource from storage.
     */
    public function destroy(deposit $deposit)
    {
        //
        $deleted = $deposit->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
