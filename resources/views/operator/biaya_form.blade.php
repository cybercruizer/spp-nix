@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model,['route'=> $route,'method'=>$method]) !!}
                    <div class="mb-3 mt-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        {!! Form::select('tahun', [
                            '2022'=>'2022',
                            '2023'=>'2023',
                            '2024'=>'2024',
                            '2025'=>'2025'
                            ], date('Y'), ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                      </div>
                    <div class="mb-3 mt-3">
                      <label for="nama" class="form-label">Nama Tagihan</label>
                      {!! Form::text('nama', null , ['class'=>'form-control','autofocus']) !!}
                      <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                    <label for="jumlah" class="form-label">Nominal</label><br>
                    <div class="input-group mb-3" id="jumlah"> 
                        <span class="input-group-text">Rp </span>
                        {!! Form::text('jumlah', null , ['class'=>'form-control rupiah']) !!}
                        <span class="input-group-text">,00</span>
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>

                    {!! Form::submit($button, ['class'=>'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
