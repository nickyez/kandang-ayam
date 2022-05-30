@extends('template.admin')

@section('title', 'Kontrol Lampu')

@push('custom-style')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Status Lampu</h6>
        </div>
        <form action="#" method="get">
            <div class="card-body">
                <div class="form-group">
                    <label for="mode" class="small mb-1">Mode</label>
                    <div id="mode" class="btn-group btn-group-toggle btn-group-sm mx-4" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="mode" id="otomatis" value="auto" autocomplete="off" checked> Otomatis
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="mode" id="manual" value="manual" autocomplete="off"> Manual
                        </label>
                    </div>
                </div>
                <div class="row" id="show">
                    <div class="form-group col-md-4">
                        <div class="small mb-1">Jam Mulai</div>
                        <input type="time" class="form-control" name="time_on" id="time_on">
                    </div>
                    <div class="form-group col-md-4">
                        <div class="small mb-1">Jam Akhir</div>
                        <input type="time" class="form-control" name="time_off" id="time_off">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 mb-3">
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="fas fa-edit"></i>
                            Ubah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('page-script')
    <script>
        $(document).ready(function() {
            $('input[name=mode]').on('change', function() {
                var n = $(this).val();
                switch (n) {
                    case 'auto':
                        $('#show').html(`
                        <div class="form-group col-md-4">
                            <div class="small mb-1">Jam Mulai</div>
                            <input type="time" class="form-control" name="time_on" id="time_on">
                        </div>
                        <div class="form-group col-md-4">
                            <div class="small mb-1">Jam Akhir</div>
                            <input type="time" class="form-control" name="time_off" id="time_off">
                        </div>
                        `);
                        break;
                    case 'manual':
                        $('#show').html(`
                        <div class="form-group col-md-4">
                            <div class="small mb-1">Batas suhu untuk menyala</div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-9">
                                    <input type="range" class="form-range w-100" min="25" max="35" value="30" name="suhu"
                                        id="suhu" oninput="document.getElementById('label-range').innerHTML = this.value">
                                </div>
                                <div class="col-3">
                                    <span class="small mb-1 text-center" id="label-range">30</span>
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
@endpush
