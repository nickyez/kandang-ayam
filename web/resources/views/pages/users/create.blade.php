@extends('template.admin')

@section('title', 'Users')

@push('custom-style')
    <link href="{{ asset('package/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    @if ($errors->has('username'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $errors->first('username') }}</strong>          
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->has('email'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $errors->first('email') }}</strong>          
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pengguna</h6>
                <a href="{{ url('/users') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
        <form action="{{url('users')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="small mb-1">Profile Picture</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/png, image/gif, image/jpeg" name="photo"
                            id="photo" onchange="showname()">
                        <label class="custom-file-label" id="label-photo" for="photo">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Nama</div>
                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Username</div>
                    <input type="text" class="form-control" name="username" id="username"
                        placeholder="username maximum 8 character with alphanumeric" required>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Email</div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Password</div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password minimal 8 character" required>
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 mb-3">
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i>
                            Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('page-script')
<script>
    function showname() {
        var name = document.getElementById('photo');
        var label = document.getElementById('label-photo');
        label.innerHTML = name.files.item(0).name;
    };
</script>
@endpush

