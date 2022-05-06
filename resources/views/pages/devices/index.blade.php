@extends('template.admin')

@section('title', 'Devices')

@push('custom-style')
    <link href="{{asset('package/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Devices</h6>
                <a href="{{Request::url()."/create"}}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Tambah Devices</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID device</th>
                            <th>Nama Pemilik</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Device</th>
                            <th>Nama Pemilik</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>A0001</td>
                            <td>Nicky Erlangga</td>
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
