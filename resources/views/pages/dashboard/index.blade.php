@extends('template.admin')

@section('title', 'Dashboard')

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
                        <form action="/" method="post">
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
                                    <form action="/" method="post">
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
        <!-- Content Row -->
        <div class="row">
            <!-- Suhu -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Suhu Kandang</div>
                                @if (isset($getLastTempData))
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getLastTempData->temp }}°C
                                    </div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- kelembapan -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Kelembapan</div>
                                @if (isset($getLastTempData))
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getLastTempData->humi }}%
                                    </div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Status Lampu -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Status Lampu</div>
                                @if (isset($getLastLampStatus))
                                    @if ($getLastLampStatus->status != 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Nyala</div>
                                    @else
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Mati</div>
                                    @endif
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Suhu Kandang / Jam</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="kondisiSuhuChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="position-fixed top-0 right-0 p-3 w-25" style="z-index: 5; top: 0; right:0">
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="2000">
                    <div class="toast-header bg-success">
                        <strong class="mr-auto text-white">Bootstrap</strong>
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
    <script src="{{ asset('package/chart.js/Chart.min.js') }}"></script>
    <script>
        function changeDevice() {
            var end = $("#device").val()
            window.history.replaceState(null, null, `?d=${end}`);
            location.reload();
        };
    </script>
    @if (session('message'))
        <script>
            $('#liveToast').toast('show')
        </script>
    @endif
@endpush

@push('data-script')
    <script src="{{ asset('js/chart/kondisi_suhu.js') }}"></script>
@endpush
