@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model,['route'=> $route,'method'=>$method]) !!}
                    <label>PILIH TAGIHAN YANG AKAN DITAGIHKAN</label>
                    <div class="card mt-3 border">
                        <div class="card-body">
                        @foreach ($biaya as $item )
                            <div class="form-check mt-3 card-text">
                                {!! Form::checkbox('biaya_id[]', $item->id, null, [
                                    'class'=> 'form-check-input',
                                    'id'=>'defaultCheck'. $loop->iteration,
                                    ]) !!}
                                <label class="form-check-label" for="defaultCheck{{ $loop->iteration }}">
                                    {{ $item->nama_Biaya_Full }}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                            <label for="angkatan" class="form-label">Tagihan untuk angkatan</label>
                            {!! Form::select('angkatan', $angkatan, null, ['class'=>'form-control','placeholder'=>'Pilih angkatan']) !!}
                            <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                        </div>
                      <div class="mb-3 mt-3">
                        <label for="kelas" class="form-label">Tagihan untuk kelas</label>
                        {!! Form::select('kelas', $kelas, null, ['class'=>'form-control select2','placeholder'=>'Pilih kelas']) !!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                      </div>
                      <div class="form-group mt-3">
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-d'), ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_tagihan') }}</span>
                      </div>
                      <div class="form-group mt-3">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_tagihan ?? date('Y-m-d'), ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo') }}</span>
                      </div>
                      <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class'=>'form-control','rows'=>'3']) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                      </div>
                    

                    {!! Form::submit($button, ['class'=>'btn btn-success mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
