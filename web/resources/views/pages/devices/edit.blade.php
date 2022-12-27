@extends('template.admin')

@section('title', 'Devices')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Devices</h6>
                <a href="{{url('/devices')}}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
        <form action="{{url('/devices').'/'.$device->id}}" method="POST">
            @csrf
            @method('PUT')
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
                    <input type="text" class="form-control" name="device_id" id="device_id" placeholder="ex: ID001" value="{{$device->id}}" maxlength="8" required>
                </div>
                <div class="form-group">
                    <div class="small mb-1">Pengguna</div>
                    <select class="custom-select" aria-label="Default select example" name="user">
                        <option value="" @if(empty($device->user_id)) selected @endif>Belum ada pengguna</option>
                        @foreach ($users as $item)
                            <option value="{{$item->id}}" @if($device->user_id == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
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
