@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model,[
                        'route'=> $route,
                        'method'=>$method,
                        'files' => true,
                    ]) !!}
                    <div class="form-group mt-3">
                        <label for="wali_id" class="form-label">Nama Wali</label>
                        {!! Form::select('wali_id', $wali, null, ['class'=>'form-control select2','placeholder'=>'Pilih nama wali']) !!}
                        <span class="text-danger">{{ $errors->first('wali_id') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="nama" class="form-label">Nama Siswa</label>
                      {!! Form::text('nama', null , ['class'=>'form-control','autofocus']) !!}
                      <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="nis" class="form-label">NIS</label>
                        {!! Form::text('nis', null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nis') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="nisn" class="form-label">NISN</label>
                        {!! Form::text('nisn', null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nisn') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        {!! Form::text('kelas', null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        {!! Form::select('jurusan',[
                            'TKJ' => 'Teknik Komputer dan Jaringan',
                            'TITL' => 'Teknik Instalasi Tenaga Listrik',
                            'TPM' => 'Teknik Pemesinan',
                            'TKR' => 'Teknik Kendaraan Ringan',
                            'TSM' => 'Teknik Sepeda Motor',
                            'KUL' => 'Kuliner/ Tata Boga',
                            'PHT' => 'Perhotelan'
                        ], null, ['class'=>'form-control select2']) !!}
                        <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        {!! Form::selectRange('angkatan', 2022, date('Y')+1, date('Y'), ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        {!! Form::textarea('alamat', null , ['class'=>'form-control','rows'=>'3']) !!}
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        {!! Form::text('nohp',null, ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>
                    @if($model->foto != null)
                        <div class="mb-3 mt-3">
                            <img src="{{ \Storage::url($model->foto) }}" alt="foto-{{ $model->nama }}" width="200">
                        </div>
                    @endif
                    <div class="mb-3 mt-3">
                        <label for="foto" class="form-label">Foto (Format: jpg, jpeg,png. Ukuran maks: 5 MB)</label>
                        {!! Form::file('foto', ['class'=>'form-control','accept'=>'image/*']) !!}
                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                    </div>
                    {!! Form::submit($button, ['class'=>'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
