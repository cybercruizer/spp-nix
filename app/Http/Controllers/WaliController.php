<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;

use function PHPUnit\Framework\returnSelf;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $viewIndex = 'wali_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'wali_show';
    private $routePrefix = 'wali';

    public function index()
    {
        return view('operator.'.$this->viewIndex,[
            'models'=>Model::wali()
            ->latest()
            ->paginate(3),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Wali'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data= [
            'model' => new Model,
            'method' => 'POST',
            'route' => $this->routePrefix.'.store',
            'button' => 'SIMPAN',
            'title' => 'Form Wali Murid',
        ];
        return view('operator.'.$this->viewCreate,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData= $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'password' => 'required'
        ]);
        $requestData['password']=bcrypt($requestData['password']);
        $requestData['email_verified_at']=now();
        $requestData['akses']='wali';
        Model::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model= Model::wali()->where('id',$id)->firstOrFail();
        return view('operator.'.$this->viewShow,[
            'model' => $model,
            'title' => 'Detail wali murid'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix .'.update',$id],
            'button' => 'UPDATE',
            'title' => 'Form Wali Murid'
        ];
        return view('operator.'.$this->viewEdit,$data);
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
        $requestData= $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'nohp' => 'required|unique:users,nohp,'.$id,
            'password' => 'nullable'
        ]);
        $model=Model::findOrFail($id);
        if ($requestData['password']=="")
        {
            unset($requestData['password']);
        } else {
            $requestData['password']=bcrypt($requestData['password']);
        }
        $requestData['akses']='wali';
        $model->fill($requestData);
        $model->save();
        flash('Data berhasil diubah');
        return redirect()->route($this->routePrefix. '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Model::wali()->where('id',$id)->firstOrFail();
        $model->delete();
        flash ('Data berhasil dihapus');
        return back();
    }
}
