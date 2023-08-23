@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="table-responsive">
                       <img src="{{ \Storage::url($model->foto ?? 'images/no-image.png') }}" width="150" />
                        <table class="table table-stripped table-sm">
                                <tr>
                                    <td width="15%">ID</td>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $model->nama }}</td>
                                </tr>
                                <tr>
                                    <td>NIS</td>
                                    <td>{{ $model->nis }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>{{ $model->jurusan }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>{{ $model->kelas }}</td>
                                </tr>  
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection