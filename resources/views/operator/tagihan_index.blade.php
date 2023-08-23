@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route($routePrefix.'.create')}}" class="btn btn-primary">Tambah {{ $routePrefix }}</a>
                        </div>
                        <div class="col-md-6">
                            {!! Form::open(['route'=>$routePrefix.'.index','method'=>'GET']) !!}
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        {!! Form::selectMonth('bulan', request('bulan'), ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        {!! Form::selectRange('tahun', date('Y')-1, date('Y')+1, request('tahun'), ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <button type="submit" class="btn btn-primary">Cari!</button>
                                    </div>
                              </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal tagihan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nisn ?? '' }}</td>
                                        <td>{{ $item->siswa->nama ?? '' }}</td>
                                        <td>{{ $item->formatRupiah('jumlah_biaya') }}</td>
                                        <td>{{ $item->tanggal_tagihan->translatedFormat('d M Y')  }}</td>
                                        <td>{{ $item->status  }}</td>
                                        <td>

                                            {!! Form::open([
                                                'route'=>[$routePrefix.'.destroy',$item->id],
                                                'method'=>'DELETE',
                                                'onsubmit'=> 'return confirm("Yakin menghapus data ini?")'
                                            ]) !!}
                                            {{-- <a href="{{ route($routePrefix.'.edit',$item->id) }}" class="btn btn-sm btn-success">Edit</a>  --}}
                                            <a href="{{ route($routePrefix.'.show',[
                                                $item->siswa_id,
                                                'siswa_id' => $item->siswa_id,
                                                'bulan' => $item->tanggal_tagihan->format('m'),
                                                'tahun' => $item->tanggal_tagihan->format('Y'),
                                            ]) }}" class="btn btn-sm btn-info">Detail</a>
                                            {!! Form::submit('hapus',['class'=>'btn btn-sm btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Data tidak ada</td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    {!! $models->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
