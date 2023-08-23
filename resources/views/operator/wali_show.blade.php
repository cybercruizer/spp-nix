@extends('layouts.app_sneat')
@section('content')
    <div class="row justify-content-center">
        <div class="com-md-12">
            <div class="card">
                <h5 class="card-header">
                    {{ $title }}
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-sm">
                                <tr>
                                    <td width="15%">ID</td>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $model->name }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>{{ $model->nohp }}</td>
                                </tr>
                                <tr>
                                    <td>e-mail</td>
                                    <td>{{ $model->email }}</td>
                                </tr>  
                        </table>
                        <br>
                        <h5>Data anak</h5>
                        <table class="table table-stripped">
                            <thead>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                            </thead>
                            <tbody>
                                @foreach ($model->siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection