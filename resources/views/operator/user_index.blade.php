@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <a href="{{route($routePrefix.'.create')}}" class="btn btn-primary">Tambah {{ $routePrefix }}</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                    <th>email</th>
                                    <th>Akses</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->nohp }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->akses  }}</td>
                                        <td>

                                            {!! Form::open([
                                                'route'=>[$routePrefix.'.destroy',$item->id],
                                                'method'=>'DELETE',
                                                'onsubmit'=> 'return confirm("Yakin menghapus data ini?")'
                                            ]) !!}
                                            <a href="{{ route($routePrefix.'.edit',$item->id) }}" class="btn btn-sm btn-success">Edit</a>

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
