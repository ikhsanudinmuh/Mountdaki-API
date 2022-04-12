<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MountainController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mountain = Mountain::all();

        return $this->sendResponse($mountain);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'location' => 'required',
            'height' => 'required|numeric',
            'basecamp' => 'required|numeric' 
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 422);
        }

        $mountain = $request->all();

        try {
            $mountain = Mountain::create($mountain);
            return $this->sendResponse($mountain, 'Gunung berhasil ditambahkan');
        } catch (QueryException $e) {
            return $this->sendError('Gunung gagal ditambahkan', $e->errorInfo, 400);
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
        $mountain = Mountain::where('id', $id)->first();

        if ($mountain) {
            return $this->sendResponse($mountain);
        } else {
            return $this->sendError('Gunung tidak ditemukan');
        }
    }

    public function search($name)
    {
        $mountain = Mountain::where('name', 'LIKE', '%'.$name.'%')->get();

        if ($mountain) {
            return $this->sendResponse($mountain);
        } else {
            return $this->sendError('Gunung tidak ditemukan');
        }
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
        $auth = $request->user();

        if ($auth->tokenCan('admin')) {
            $mountain = DB::table('mountains')->where('id', $id);

            if($mountain == null) {
                return $this->sendError('Gunung tidak ditemukan');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required',
                'location' => 'required',
                'height' => 'required|numeric',
                'basecamp' => 'required|numeric' 
            ]);
    
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), [], 422);
            }

            try {
                $mountain->update($request->all());

                return $this->sendResponse('', 'Data gunung berhasil diubah');
            } catch (QueryException $e) {
                return $this->sendError('Data gunung gagal diubah', $e->errorInfo, 400);
            }
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
