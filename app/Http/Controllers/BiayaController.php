<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiayaRequest;
use App\Http\Requests\UpdateBiayaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Models\Biaya as Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnSelf;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $viewIndex = 'biaya_index';
    private $viewCreate = 'biaya_form';
    private $viewEdit = 'biaya_form';
    private $viewShow = 'biaya_show';
    private $routePrefix = 'biaya';

    public function index()
    {
        return view('operator.'.$this->viewIndex,[
            'models'=>Model::latest()->paginate(3),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Tagihan'
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
            'title' => 'Form Data Biaya',
        ];
        return view('operator.'.$this->viewCreate,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBiayaRequest $request)
    {
        Model::create($request->validated());
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
        $data= [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix .'.update',$id],
            'button' => 'UPDATE',
            'title' => 'Form Data Biaya',
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
    public function update(UpdateBiayaRequest $request, $id)
    {
        $model=Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Model::where('id',$id)->firstOrFail();
        $model->delete();
        flash ('Data berhasil dihapus');
        return back();
    }
}
