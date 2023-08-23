<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \App\Models\Siswa as Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnSelf;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $viewIndex = 'siswa_index';
    private $viewCreate = 'siswa_form';
    private $viewEdit = 'siswa_form';
    private $viewShow = 'siswa_show';
    private $routePrefix = 'siswa';

    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user','wali')->search($request->q)->paginate(2);
        } else {
            $models = Model::with('wali','user')->latest()->paginate(3);
        }
        return view('operator.'.$this->viewIndex,[
            'models'=>$models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Siswa'
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
            'title' => 'Form Data Siswa',
            'wali' => User::where('akses','wali')->pluck('name','id'),
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
            'wali_id'   => 'nullable',
            'nama'      => 'required',
            'nis'       => 'required',
            'nisn'      => 'nullable|unique:siswas',
            'kelas'     => 'required',
            'jurusan'   => 'required',
            'angkatan'  => 'required',
            'alamat'    => 'required',
            'nohp'      => 'required',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
        ]);
        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('public/foto_siswa');
        }
        if ($request->filled('wali_id')) {
            $requestData['wali_status']='ok';
        }       
        $requestData['user_id']=auth()->user()->id;
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
        $model= Model::findOrFail($id);
        return view('operator.'.$this->viewShow,[
            'model' => $model,
            'title' => 'Detail Siswa'
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
            'title' => 'Form Data Siswa',
            'wali' => User::wali()->pluck('name','id'),
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
            'wali_id'   => 'nullable',
            'nama'      => 'required',
            'nis'       => 'required',
            'nisn'      => 'nullable|unique:siswas,nisn,'.$id,
            'kelas'     => 'required',
            'jurusan'   => 'required',
            'angkatan'  => 'required',
            'alamat'    => 'required',
            'nohp'      => 'required',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
        ]);
        $model=Model::findOrFail($id);
        if ($request->hasFile('foto')) {
            Storage::delete($model->foto);
            $requestData['foto'] = $request->file('foto')->store('public/foto_siswa');
        }
        if ($request->filled('wali_id')) {
            $requestData['wali_status']='ok';
        }
        $requestData['user_id']=auth()->user()->id;
        $model->fill($requestData);
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
