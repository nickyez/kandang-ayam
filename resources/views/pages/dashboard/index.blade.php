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
                                    @if ($getLastTempData->count() != 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $getLastTempData[0]->temp }}°C
                                        </div>
                                    @else
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
                                    @endif
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
                                    @if ($getLastTempData->count() != 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $getLastTempData[0]->humi }}%
                                        </div>
                                    @else
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>
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
    @if (isset($getLastTempData))
        <?php
        $label = [];
        $time = \Carbon\Carbon::now();
        $hour = $time->hour;
        $cond = [];
        $cond[] = $hour - 5;
        $cond[] = $hour - 4;
        $cond[] = $hour - 3;
        $cond[] = $hour - 2;
        $cond[] = $hour - 1;
        $cond[] = $hour;
        $hour < 10 ? '0' . (string) $hour : $hour;
        $label[] = $hour - 5 . ':00';
        $label[] = $hour - 4 . ':00';
        $label[] = $hour - 3 . ':00';
        $label[] = $hour - 2 . ':00';
        $label[] = $hour - 1 . ':00';
        $label[] = $hour . ':00';
        $data = [];
        if ($getLastTempData->count() == 0) {
            if (empty($data[0])) {
                $data[0] = 0;
            }
            if (empty($data[1])) {
                $data[1] = 0;
            }
            if (empty($data[2])) {
                $data[2] = 0;
            }
            if (empty($data[3])) {
                $data[3] = 0;
            }
            if (empty($data[4])) {
                $data[4] = 0;
            }
            if (empty($data[5])) {
                $data[5] = 0;
            }
        }
        for ($i = $getLastTempData->count() - 1; $i >= 0; $i--) {
            $isSameDay = date_format($time, 'Y-m-d') == date('Y-m-d', strtotime($getLastTempData[$i]->waktu));
            if ($isSameDay) {
                if ($cond[0] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[0] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[0])) {
                        $data[0] = 0;
                    }
                }
                if ($cond[1] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[1] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[1])) {
                        $data[1] = 0;
                    }
                }
                if ($cond[2] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[2] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[2])) {
                        $data[2] = 0;
                    }
                }
                if ($cond[3] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[3] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[3])) {
                        $data[3] = 0;
                    }
                }
                if ($cond[4] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[4] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[4])) {
                        $data[4] = 0;
                    }
                }
                if ($cond[5] == date('G', strtotime($getLastTempData[$i]->waktu))) {
                    $data[5] = $getLastTempData[$i]->temp;
                } else {
                    if (empty($data[5])) {
                        $data[5] = 0;
                    }
                }
            } else {
                if (empty($data[0])) {
                    $data[0] = 0;
                }
                if (empty($data[1])) {
                    $data[1] = 0;
                }
                if (empty($data[2])) {
                    $data[2] = 0;
                }
                if (empty($data[3])) {
                    $data[3] = 0;
                }
                if (empty($data[4])) {
                    $data[4] = 0;
                }
                if (empty($data[5])) {
                    $data[5] = 0;
                }
            }
        }
        ?>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito',
                '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            var list = ['<?php echo $label[0]; ?>', '<?php echo $label[1]; ?>', '<?php echo $label[2]; ?>', '<?php echo $label[3]; ?>',
                '<?php echo $label[4]; ?>', '<?php echo $label[5]; ?>'
            ];
            var data = [<?php foreach ($data as $d) {
                echo $d . ',';
            } ?>];
            // Area Chart Example
            var ctx = document.getElementById("kondisiSuhuChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: list,
                    datasets: [{
                        label: "Suhu",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return value + '°C';
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ':' + tooltipItem.yLabel + '°C';
                            }
                        }
                    }
                }
            });
        </script>
    @endif
@endpush
