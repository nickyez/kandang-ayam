@extends('template.admin')

@section('title', 'Devices')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Devices</h6>
                <a href="{{ url('/devices') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
        <form action="{{url('/devices')}}" method="POST">
            @csrf
            <div class="card-body">
                @error('device_id')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <div class="small mb-1">ID Device</div>
                    <input type="text" class="form-control" name="device_id" id="device_id" placeholder="ex: ID001"
                        maxlength="8" required>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Pengguna</div>
                    <select class="custom-select" aria-label="Default select example" name="user">
                        <option selected>Belum ada pengguna</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
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
