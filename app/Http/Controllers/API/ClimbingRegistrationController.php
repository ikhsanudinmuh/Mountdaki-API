<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\ClimbingRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $climbing = DB::table('climbing_registrations')
                        ->leftJoin('users', 'climbing_registrations.user_id', '=', 'users.id')
                        ->leftJoin('mountains', 'climbing_registrations.mountain_id', '=', 'mountains.id')
                        ->select('climbing_registrations.*', 'users.name as user_name', 'mountains.name as mountain_name')
                        ->get();

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
            'mountain_id' => 'required',
            'schedule' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 422);
        }
        // $identity_card = $request->file('identity_card');
        // $identity_card_name = $identity_card->getClientOriginalName();
        $request->merge([
            'user_id' => $auth->id,
        ]);
        
        try {
            // $identity_card->move(public_path('/assets/images'), $identity_card_name); 
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
    public function show(Request $request, $id)
    {
        $climbing = DB::table('climbing_registrations')
                        ->leftJoin('users', 'climbing_registrations.user_id', '=', 'users.id')
                        ->leftJoin('mountains', 'climbing_registrations.mountain_id', '=', 'mountains.id')
                        ->select('climbing_registrations.*', 'users.name as user_name', 'mountains.name as mountain_name')
                        ->where('climbing_registrations.id', '=', $id)
                        ->first();

        $auth = $request->user();
        if ($auth->id == $climbing->user_id || $auth->tokenCan('admin')) {
            return $this->sendResponse($climbing);
        } else {
            return $this->sendError('Anda tidak memiliki akses ke halaman ini', [], 401);
        }

    }

    public function showByUserId(Request $request, $id) {
        $climbing = DB::table('climbing_registrations')
                        ->leftJoin('users', 'climbing_registrations.user_id', '=', 'users.id')
                        ->leftJoin('mountains', 'climbing_registrations.mountain_id', '=', 'mountains.id')
                        ->select('climbing_registrations.*', 'mountains.name as mountain_name', 'users.name as user_name')
                        ->where('climbing_registrations.user_id', '=', $id)
                        ->get();

        $auth = $request->user();
        // if ($auth->id == $climbing->user_id) {
        //     return $this->sendResponse($climbing);
        // } else {
        //     return $this->sendError('Anda tidak memiliki akses ke halaman ini', [], 401);
        // }
        return $this->sendResponse($climbing);
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

    public function approve($id) {
        $climbing = DB::table('climbing_registrations')->where('id', $id);

        if ($climbing->first() == null) {
            return $this->sendError('Data pendaftaran tidak ditemukan');
        }

        try {
            $climbing->update(['status' => 'approved']);
            return $this->sendResponse([], 'Status pendaftaran diubah menjadi (disetujui)');
        } catch (QueryException $e) {
            return $this->sendError('Status pendaftaran gagal diubah', $e->errorInfo, 400);
        }  
    }

    public function decline($id) {
        $climbing = DB::table('climbing_registrations')->where('id', $id);

        if ($climbing->first() == null) {
            return $this->sendError('Data pendaftaran tidak ditemukan');
        }

        try {
            $climbing->update(['status' => 'declined']);
            return $this->sendResponse([], 'Status pendaftaran diubah menjadi (ditolak)');
        } catch (QueryException $e) {
            return $this->sendError('Status pendaftaran gagal diubah', $e->errorInfo, 400);
        }  
    }

    public function climb(Request $request, $id) {
        $auth = $request->user();

        $climbing = DB::table('climbing_registrations')->where('id', $id);
        
        if ($climbing->first() == null) {
            return $this->sendError('Data pendaftaran tidak ditemukan');
        }

        if ($auth->id == $climbing->first()->user_id) {
            try {
                $climbing->update(['status' => 'climbing']);
                return $this->sendResponse([], 'Status pendaftaran diubah menjadi (mendaki)');
            } catch (QueryException $e) {
                return $this->sendError('Status pendaftaran gagal diubah', $e->errorInfo, 400);
            }  
        } else {
            return $this->sendError('Data pendaftaran ini bukan milik anda', [], 401);
        }

    }

    public function done(Request $request, $id) {
        $auth = $request->user();

        $climbing = DB::table('climbing_registrations')->where('id', $id);
        
        if ($climbing->first() == null) {
            return $this->sendError('Data pendaftaran tidak ditemukan');
        }

        if ($auth->id == $climbing->first()->user_id) {
            try {
                $climbing->update(['status' => 'done']);
                return $this->sendResponse([], 'Status pendaftaran diubah menjadi (selesai)');
            } catch (QueryException $e) {
                return $this->sendError('Status pendaftaran gagal diubah', $e->errorInfo, 400);
            }  
        } else {
            return $this->sendError('Data pendaftaran ini bukan milik anda', [], 401);
        }

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
