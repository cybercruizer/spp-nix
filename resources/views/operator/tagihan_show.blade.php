@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ strtoupper('detail tagihan '. $periode) }}</h5>

                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <td rowspan="8" width="30%">
                                <img src="{{ \Storage::url($siswa->foto) }}" alt="{{ $siswa->nama }}" height="150">
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>: {{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $siswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $siswa->kelas }}</td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td>: {{ $siswa->jurusan }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $siswa->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-5">
            <div class="card">
                <h5 class="card-header">
                    Tagihan
                </h5>
                <div class="card-body">
                    body
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <h5 class="card-header">
                    Pembayaran
                </h5>
                <div class="card-body">
                    body
                </div>
            </div>
        </div>
    </div>
@endsection
