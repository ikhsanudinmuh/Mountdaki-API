<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\ClimbingRegistration;
use App\Models\Mountain;
use App\Models\Rating;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'climbing_registration_id' => 'required|numeric',
            'review' => 'required',
            'rate' => 'required'
        ]);

        
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 422);
        }
        
        $mountain_id = ClimbingRegistration::where('id', $request->climbing_registration_id)->first()->mountain_id;
        
        $request->merge([
            'mountain_id' => $mountain_id,
            'user_id' => $auth->id
        ]);

        try {
            $rating = Rating::create($request->all());
            return $this->sendResponse($rating, 'Rating berhasil ditambahkan, terima kasih');
        } catch (QueryException $e) {
            return $this->sendError('Rating gagal ditambahkan', $e->errorInfo, 400);
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
