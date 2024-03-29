@extends('template.admin')

@section('title', 'Users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Pengguna</h6>
                <a href="{{ url('/users') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
        <form action="{{ url('/users') . '/' . $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="small mb-1">Profile Picture</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/png, image/gif, image/jpeg"
                            name="photo" id="photo" onchange="showname()">
                        <label class="custom-file-label" id="label-photo" for="photo">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Nama</div>
                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe"
                        value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <div class="small mb-1">Username</div>
                    <input type="text" class="form-control" name="username" id="username"
                        placeholder="username maximum 8 character with alphanumeric" value="{{ $user->username }}">
                </div>
                <div class="form-group">
                    <div class="small mb-1">Email</div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <div class="small mb-1">Password</div>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="password minimal 8 character">
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 mb-3">
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i>
                            Ubah</button>
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
