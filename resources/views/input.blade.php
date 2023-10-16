@extends('layouts.app')

@section('content')
<form action="{{ route('admin.store') }}" method="post">
    @csrf

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="temperature" class="col-sm-3 col-form-label">Lokus</label>
                <select class="custom-select col-sm-8" id="monitoring_point_id" name="monitoring_point_id">
                    <option selected>Choose...</option>
                    @foreach ($monitoring_point as $value)
                    <option value="{{$value->id}}">{{$value->monitoring_point}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="ph" class="col-sm-3 col-form-label">Waktu Sampling</label>
                <select class="custom-select my-1 col-sm-8" id="sampling_time_id" name="sampling_time_id" onchange="sampling_handler()">
                    <option selected>Choose...</option>>
                    <option value='-1'>Tambah waktu sampling</option>>
                    @foreach ($sampling_time as $value)
                    <option value="{{$value->id}}">{{explode('-',$value->time)[0]}} Tahap {{$value->quarter}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <script>
        function sampling_handler() {
            var x = document.getElementById("sampling_time_id").value;
            if (x == '-1') { // require a URL
                window.location ='admin/waktu-sampling'; // redirect

            }
            return false;
        }
    </script>
    <!-- <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label for="quarter" class="col-sm-3 col-form-label">Periode</label>
                    <select class="custom-select col-sm-8" id="quarter" name="quarter">
                        <option selected>Choose...</option>
                        <option value="1">Tahap 1</option>
                        <option value="2">Tahap 2</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group row">
                    <label for="year" class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" class="form-control" id="year" name="year">
                    </div>
                </div>
            </div>
        </div> -->

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="temperature" class="col-sm-3 col-form-label">Temperatur</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="temperature" name="temperature">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="ph" class="col-sm-3 col-form-label">pH</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="ph" name="ph">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="dhl" class="col-sm-3 col-form-label">DHL</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="dhl" name="dhl">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="tds" class="col-sm-3 col-form-label">TDS</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="tds" name="tds">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="tss" class="col-sm-3 col-form-label">TSS</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="tss" name="tss">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="do" class="col-sm-3 col-form-label">DO</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="do" name="do">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="bod" class="col-sm-3 col-form-label">BOD</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="bod" name="bod">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="cod" class="col-sm-3 col-form-label">COD</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="cod" name="cod">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="no_2" class="col-sm-3 col-form-label">NO2</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="no_2" name="no_2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="no_3" class="col-sm-3 col-form-label">NO3</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="no_3" name="no_3">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="nh_2" class="col-sm-3 col-form-label">NH2</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="nh_2" name="nh_2">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="clorin" class="col-sm-3 col-form-label">Klorin Bebas</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="clorin" name="clorin">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="total_fosfat" class="col-sm-3 col-form-label">Total Posfat</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="total_fosfat" name="total_fosfat">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="fenol" class="col-sm-3 col-form-label">Fenol</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="fenol" name="fenol">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="oil" class="col-sm-3 col-form-label">Minyak&Lemak</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="oil" name="oil">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="detergent" class="col-sm-3 col-form-label">Detergen</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="detergent" name="detergent">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="fecal_coliform" class="col-sm-3 col-form-label">Fecal Coliform</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="fecal_coliform" name="fecal_coliform">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="total_coliform" class="col-sm-3 col-form-label">Total Coliform</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="total_coliform" name="total_coliform">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="cyanide" class="col-sm-3 col-form-label">Sianida</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="cyanide" name="cyanide">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="h2s" class="col-sm-3 col-form-label">H2S</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="h2s" name="h2s">
                </div>
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-primary my-1">Submit</button>
</form>
@endsection