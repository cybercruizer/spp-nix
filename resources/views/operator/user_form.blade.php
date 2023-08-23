@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model,['route'=> $route,'method'=>$method]) !!}
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Nama</label>
                      {!! Form::text('name', null , ['class'=>'form-control','autofocus']) !!}
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">email</label>
                        {!! Form::text('email', null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="nohp" class="form-label">No HP</label>
                        {!! Form::text('nohp', null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="password" class="form-label">Password</label>
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    @if (\Route::is('user.create'))

                    <div class="mb-3 mt-3">
                        <label for="akses" class="form-label">Hak akses</label>
                        {!! Form::select('akses', [
                            'operator' => 'Operator Sekolah',
                            'admin' => 'Administrator'
                            ], null , ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('akses') }}</span>
                    </div>

                    @endif
                    {!! Form::submit($button, ['class'=>'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
