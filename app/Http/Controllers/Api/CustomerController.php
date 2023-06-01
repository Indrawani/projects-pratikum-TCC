<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\customer;

class CustomerController extends Controller
{
    public function index()
    {
        // untuk show data resto
        $customer = customer::all();

        if(count($customer) > 0)
        {
            return response([
                'message' => 'Retrieve All restoran Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        // untuk menambahkan data resto baru
        $customerData = $request->all();
        $validate = Validator::make($customerData, [
            'nama_restoran' => 'required|max:60',
            'nama_pelanggan' => 'required',
            'email_pelanggan' => 'required',
            'tanggal_booking' => 'required',
            'jenis_makanan' => 'required',
            'nomor_meja' => 'required',
            'status_booking' => 'required',
        ]);

        if($validate->fails())
        {
            return response([
                'message' => $validate->errors()
            ],400);
        }

        $customer = customer::create($customerData);
        return response([
            'message' => 'Add Restoran Success',
            'data' => $customer
        ], 200);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        // untuk show resto berdasarkan pencarian
        $customer = customer::find($id);

        if(!is_null($customer)) {
            return response([
                'message' => 'Retrieve Restoran Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Restoran Not Found',
            'data' => null
        ], 404);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(customer $customer)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        //untuk mengubah 1 data umkm
        $customer = customer::find($id);
        if(is_null($customer))
        {
            return response([
                'message' => 'Restoran Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_restoran' => 'required|max:60',
            'nama_pelanggan' => 'required',
            'email_pelanggan' => 'required',
            'tanggal_booking' => 'required',
            'jenis_makanan' => 'required',
            'nomor_meja' => 'required',
            'status_booking' => 'required',
        ]);

        if($validate->fails())
        {
            return response([
                'message' => $validate->errors()
            ], 400);
        }

        $customer->nama_restoran = $updateData['nama_restoran'];
        $customer->nama_pelanggan = $updateData['nama_pelanggan'];
        $customer->email_pelanggan = $updateData['email_pelanggan'];
        $customer->tanggal_booking = $updateData['tanggal_booking'];
        $customer->jenis_makanan = $updateData['jenis_makanan'];
        $customer->nomor_meja = $updateData['nomor_meja'];
        $customer->status_booking = $updateData['status_booking'];

        if($customer->save())
        {
            return response([
                'message' => 'Update Restoran Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Update Restoran Failed',
            'data' => null
        ], 400);
    }
    

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\customer  $customer
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        // untuk menghapus data
        $customer = customer::find($id);

        if(is_null($customer)) {
            return response([
                'message' => 'Restoran Not Found',
                'data' => null
            ], 404);
        }

        if($customer->delete())
        {
            return response ([
                'message' => 'Delete Restoran Success',
                'data' => $customer
            ], 200);
        }

        return response ([
            'message' => 'Delete Restoran Failed',
            'data' => null,
        ], 400);
    }
}
