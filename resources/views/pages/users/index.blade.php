@extends('template.admin')

@section('title', 'Users')

@push('custom-style')
    <link href="{{ asset('package/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data pengguna</h6>
                <a href="{{Request::url()."/create"}}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah User</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Nicky Erlangga</td>
                            <td>nicky@gmail.com</td>
                            <td>Edinburgh</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                    <span class="text">Edit</span>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                    <span class="text">Delete</span>
                                </a>
                            </td>
                        </tr>
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
