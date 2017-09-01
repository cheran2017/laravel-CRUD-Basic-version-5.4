<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Customer;

//Form Requests
use App\Http\Requests\CustomerRequest;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('home', ['customers' => $customers]);
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
    public function store(CustomerRequest $request)
    {
        $customer = new Customer;

        $customer->name         = $request->name;
        $customer->email        = $request->email;
        $customer->phone_number = $request->phone_number;

        
        if ($customer->save()) {

            $request->session()->flash('alert-success', 'Customer created successfully!');
            return redirect()->back();
            
        } else {
            $request->session()->flash('alert-danger', 'Customer create failed!');
             return redirect()->back();
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
        $customer = Customer::find($request->id);

        $customer->name         = $request->name;
        $customer->email        = $request->email;
        $customer->phone_number = $request->phone_number;

        
        if ($customer->save()) {

            $request->session()->flash('alert-success', 'Customer Updated successfully!');
            return redirect()->back();
            
        } else {
            $request->session()->flash('alert-danger', 'Customer Update failed!');
             return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Customer::find($id)->delete();
        $request->session()->flash('alert-danger', 'Customer details deleted successfully!');
        return redirect()->back();
    }
}
