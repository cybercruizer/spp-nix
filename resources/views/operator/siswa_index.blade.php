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
                                <div class="input-group">
                                    <input name="q" class="form-control" type="text" placeholder="Cari data ..." aria-label="cari data" aria-describedby="button-addon2" value="{{ request('q') }}">
                                    <button type="submit" class="btn btn-outline btn-primary" id="btn-addon2">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama wali</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Jurusan</th>
                                    <th>Kelas</th>
                                    <th>Angkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->wali->name }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->jurusan  }}</td>
                                        <td>{{ $item->kelas  }}</td>
                                        <td>{{ $item->angkatan  }}</td>
                                        <td>

                                            {!! Form::open([
                                                'route'=>[$routePrefix.'.destroy',$item->id],
                                                'method'=>'DELETE',
                                                'onsubmit'=> 'return confirm("Yakin menghapus data ini?")'
                                            ]) !!}
                                            <a href="{{ route($routePrefix.'.edit',$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                            <a href="{{ route($routePrefix.'.show',$item->id) }}" class="btn btn-sm btn-success">Show</a>
                                            {!! Form::submit('hapus',['class'=>'btn btn-sm btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Data tidak ada</td>
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
