@extends('template.admin')

@section('title', 'Devices')

@push('custom-style')
    <link href="{{ asset('package/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Devices</h6>
                <a href="{{ Request::url() . '/create' }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Tambah Devices</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Device</th>
                            <th>Nama Pemilik</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Device</th>
                            <th>Nama Pemilik</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($devices as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name ?? 'Belum Ada Pengguna' }}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                            <a href="{{ Request::url() . '/' . $item->id . '/edit' }}"
                                                class="btn btn-sm btn-success mx-2">
                                                <i class="fa fa-edit"></i>
                                                <span class="text">Edit</span>
                                            </a>
                                            <form action="{{ Request::url() . '/' . $item->id }}" method="post" onclick="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mx-2">
                                                    <i class="fa fa-trash"></i>
                                                    <span class="text">Delete</span>
                                                </button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script src="{{ asset('package/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('package/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('data-script')
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush
