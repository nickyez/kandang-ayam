@extends('template.admin')

@section('title', 'Kontrol Lampu')

@push('custom-style')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endpush

@section('devices')
    @if ($devices->count() != 0)
        <div class="d-flex flex-grow-1 justify-content-end">
            <select class="custom-select col-md-4" aria-label="Default select example" id="device" name="device"
                onchange="changeDevice();">
                @foreach ($devices as $item)
                    <option value="{{ $item->id }}"
                        @if (isset($_GET['d'])) @if ($_GET['d'] == $item->id) selected @endif @endif>{{ $item->id }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#staticBackdrop">
                <i class="fas fa-plus"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambahkan ID device</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/kontrol-lampu" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="text" class="form-control" name="device_id" id="device_id"
                                    placeholder="ex: ID001" maxlength="8" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    @if ($devices->count() == 0)
        <div class="row">
            <div class="col col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6>Tambahkan device terlebih dahulu</h6>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <button type="button" class="btn btn-lg btn-primary" data-toggle="modal"
                            data-target="#staticBackdrop">
                            <i class="fas fa-plus"></i>
                            <span class="mx-2">Tambahkan device</span>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Masukkan ID device</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/kontrol-lampu" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="text" class="form-control" name="device_id" id="device_id"
                                                placeholder="ex: ID001" maxlength="8" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Lampu</h6>
            </div>
            <form action="/update-lampu" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="mode" class="small mb-1">Mode</label>
                        <div id="mode" class="btn-group btn-group-toggle btn-group-sm mx-4" data-toggle="buttons">
                            <label class="btn btn-outline-primary  @if ($getLastLampStatus->mode == 0) active @endif">
                                <input type="radio" name="mode" id="otomatis" value="0"
                                    @if ($getLastLampStatus->mode == 0) checked @endif
                                    autocomplete="off">
                                Otomatis
                            </label>
                            <label class="btn btn-outline-primary @if ($getLastLampStatus->mode == 1) active @endif">
                                <input type="radio" name="mode" id="manual" value="1"
                                    @if ($getLastLampStatus->mode == 1) checked @endif
                                    autocomplete="off">
                                Manual
                            </label>
                        </div>
                    </div>
                    @if ($getLastLampStatus->mode == 0)
                        <div class="row" id='status'>
                            <div class="col-md-4">
                                <div class="small mb-1">Batas suhu untuk lampu mati saat ini</div>
                                <div class="medium mb-1 text-danger">
                                    <strong>{{ $getLastLampStatus->suhu_mati ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="small mb-1">Batas suhu untuk lampu menyala saat ini</div>
                                <div class="medium mb-1 text-success">
                                    <strong>{{ $getLastLampStatus->suhu_nyala ?? 'N/A' }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="show">
                            <div class="form-group col-md-4">
                                <div class="small mb-1">Batas suhu untuk lampu mati</div>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-9">
                                        <input type="range" class="custom-range w-100" min="25" max="35"
                                            value="{{ $getLastLampStatus->suhu_mati }}" name="suhu_mati" id="suhu_mati"
                                            oninput="document.getElementById('label-suhu-mati').innerHTML = this.value">
                                    </div>
                                    <div class="col-3">
                                        <span class="small mb-1 text-center"
                                            id="label-suhu-mati">{{ $getLastLampStatus->suhu_mati }}</span>
                                        <span class="small mb-1">°C</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="small mb-1">Batas suhu untuk lampu menyala</div>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-9">
                                        <input type="range" class="custom-range w-100" min="25" max="35"
                                            value="{{ $getLastLampStatus->suhu_nyala }}" name="suhu_nyala"
                                            id="suhu_nyala"
                                            oninput="document.getElementById('label-suhu-nyala').innerHTML = this.value">
                                    </div>
                                    <div class="col-3">
                                        <span class="small mb-1 text-center"
                                            id="label-suhu-nyala">{{ $getLastLampStatus->suhu_nyala }}</span>
                                        <span class="small mb-1">°C</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row" id="status">
                            <div class="col-md-4">
                                <div class="small mb-1">Batas jam untuk lampu mati saat ini</div>
                                <div class="medium mb-1 text-danger">
                                    <strong>{{ $getLastLampStatus->time_off ?? 'N/A' }}</strong></div>
                            </div>
                            <div class="col-md-4">
                                <div class="small mb-1">Batas jam untuk lampu menyala saat ini</div>
                                <div class="medium mb-1 text-success">
                                    <strong>{{ $getLastLampStatus->time_on ?? 'N/A' }}</strong></div>
                            </div>
                        </div>
                        <div class="row" id="show">
                            <div class="form-group col-md-4">
                                <div class="small mb-1">Jam Mulai lampu menyala</div>
                                <input type="time" class="form-control" name="time_on" id="time_on">
                            </div>
                            <div class="form-group col-md-4">
                                <div class="small mb-1">Jam Akhir lampu mati</div>
                                <input type="time" class="form-control" name="time_off" id="time_off">
                            </div>
                        </div>
                    @endif
                    <div class="card-footer">
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary float-right btn-sm"><i class="fas fa-edit"></i>
                                Ubah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if (session('message'))
            <div class="position-fixed top-0 right-0 p-3 w-25" style="z-index: 5; top: 0; right:0">
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="2000">
                    <div class="toast-header bg-success">
                        <strong class="mr-auto text-white">Tambah Device</strong>
                        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection
@push('page-script')
    <script>
        function changeDevice() {
            var end = $("#device").val()
            window.history.replaceState(null, null, `?d=${end}`);
            location.reload();
        };
    </script>
    @if(isset($getLastLampStatus))
    <script>
        $(document).ready(function() {
            $('input[name=mode]').on('change', function() {
                var n = $(this).val();
                switch (n) {
                    case '1':
                        $('#status').html(`
                        <div class="col-md-4">
                            <div class="small mb-1">Batas jam untuk lampu mati saat ini</div>
                            <div class="medium mb-1 text-danger"><strong>{{ $getLastLampStatus->time_off ?? 'N/A' }}</strong></div>
                        </div>
                        <div class="col-md-4">
                            <div class="small mb-1">Batas jam untuk lampu menyala saat ini</div>
                            <div class="medium mb-1 text-success"><strong>{{ $getLastLampStatus->time_on ?? 'N/A' }}</strong></div>
                        </div>
                        `)
                        $('#show').html(`
                        <div class="form-group col-md-4">
                            <div class="small mb-1">Jam Mulai lampu menyala</div>
                            <input type="time" class="form-control" name="time_on" id="time_on">
                        </div>
                        <div class="form-group col-md-4">
                            <div class="small mb-1">Jam Akhir lampu mati</div>
                            <input type="time" class="form-control" name="time_off" id="time_off">
                        </div>
                        `);
                        break;
                    case '0':
                        $('#status').html(`
                        <div class="col-md-4">
                        <div class="small mb-1">Batas suhu untuk mati saat ini</div>
                        <div class="medium mb-1 text-danger"><strong>{{ $getLastLampStatus->suhu_mati ?? 'N/A' }}</strong></div>
                    </div>
                    <div class="col-md-4">
                        <div class="small mb-1">Batas suhu nyala saat ini</div>
                        <div class="medium mb-1 text-success"><strong>{{ $getLastLampStatus->suhu_nyala ?? 'N/A' }}</strong></div>
                    </div>
                        `)
                        $('#show').html(`
                        <div class="form-group col-md-4">
                        <div class="small mb-1">Batas suhu untuk lampu mati</div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-9">
                                <input type="range" class="custom-range w-100" min="25" max="35"
                                    value="{{ $getLastLampStatus->suhu_mati }}" name="suhu_mati" id="suhu_mati"
                                    oninput="document.getElementById('label-suhu-mati').innerHTML = this.value">
                            </div>
                            <div class="col-3">
                                <span class="small mb-1 text-center" id="label-suhu-mati">{{ $getLastLampStatus->suhu_mati }}</span>
                                <span class="small mb-1">°C</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="small mb-1">Batas suhu untuk lampu menyala</div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-9">
                                <input type="range" class="custom-range w-100" min="25" max="35"
                                    value="{{ $getLastLampStatus->suhu_nyala }}" name="suhu_nyala" id="suhu_nyala"
                                    oninput="document.getElementById('label-suhu-nyala').innerHTML = this.value">
                            </div>
                            <div class="col-3">
                                <span class="small mb-1 text-center" id="label-suhu-nyala">{{ $getLastLampStatus->suhu_nyala }}</span>
                                <span class="small mb-1">°C</span>
                            </div>
                        </div>
                    </div>
                        `);
                        break;
                }
            });
        });
    </script>
    @endif
@endpush
