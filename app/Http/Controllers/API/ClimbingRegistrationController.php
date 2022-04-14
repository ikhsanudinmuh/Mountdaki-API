<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\ClimbingRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClimbingRegistrationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $climbing = ClimbingRegistration::all();

        return $this->sendResponse($climbing);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = $request->user();

        $validator = Validator::make($request->all(), [
            'mountain_id' => 'required|numeric',
            'identity_card' => 'required',
            'healthy_letter' => 'required',
            'schedule' => 'required|date_format:Y/m/d'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 422);
        }
        
        $request->merge([
            'user_id' => $auth->id
        ]);
        
        try {
            $climbing = ClimbingRegistration::create($request->all());
            return $this->sendResponse($climbing, 'Pendaftaran pendakian berhasil, Data akan dicek oleh admin');
        } catch (QueryException $e) {
            return $this->sendError('Pendaftaran pendakian gagal', $e->errorInfo, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
