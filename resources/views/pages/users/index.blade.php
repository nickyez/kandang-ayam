@extends('template.admin')

@section('title', 'Users')

@push('custom-style')
    <link href="{{asset('package/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data pengguna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Foto</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Nicky Erlangga</td>
                            <td>nicky@gmail.com</td>
                            <td>Edinburgh</td>
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
