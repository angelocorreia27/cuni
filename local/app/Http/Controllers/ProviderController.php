<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\ProviderRequest;
use Request;
use App\Fornecedor;

class ProviderController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Fornecedor::all();
        return view('providers.index',compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
         $fornecedor = Fornecedor::create($request->all());

        \Session::flash('flash_message','Provider successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $fornecedor;
        }else{             
             return redirect('providers');             
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
    public function edit(Fornecedor $provider)
    {
        return view('providers.edit',compact('provider'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Fornecedor $fornecedor)
    {
        $fornecedor->update($request->all());
        \Session::flash('flash_message','Provider successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $fornecedor;
        }else{
            return redirect()->route('providers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $deleted= $fornecedor->delete();
        \Session::flash('flash_message','Provider successfully deleted.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect()->route('providers.index');
        }
    }
}
