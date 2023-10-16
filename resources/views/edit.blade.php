<form action="{{ route('admin.update', $quality->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="temperature" class="col-sm-5 col-form-label">Lokus</label>
                <select class="custom-select col-sm-6" readonly="readonly" id="monitoring_point_id" name="monitoring_point_id">
                    <option selected>{{ $quality->monitoring_point->monitoring_point}}</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="ph" class="col-sm-5 col-form-label">Waktu Sampling</label>
                <select class="custom-select my-1 col-sm-6" readonly="readonly" id="sampling_time_id" name="sampling_time_id" onchange="sampling_handler()">
                    <option selected value="{{$quality->sampling_time_id}}">{{explode('-',$quality->sampling_time->time)[0]}} Tahap {{$quality->sampling_time->quarter}}</option>>
                </select>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="temperature" class="col-sm-5 col-form-label">Temperatur</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="temperature" name="temperature" value="{{ $quality->temperature }}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="ph" class="col-sm-5 col-form-label">pH</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="ph" name="ph" value="{{ $quality->ph}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="dhl" class="col-sm-5 col-form-label">DHL</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="dhl" name="dhl" value="{{ $quality->dhl}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="tds" class="col-sm-5 col-form-label">TDS</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="tds" name="tds" value="{{ $quality->tds}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="tss" class="col-sm-5 col-form-label">TSS</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="tss" name="tss" value="{{ $quality->tss}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="do" class="col-sm-5 col-form-label">DO</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="do" name="do" value="{{ $quality->do}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="bod" class="col-sm-5 col-form-label">BOD</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="bod" name="bod" value="{{ $quality->bod}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="cod" class="col-sm-5 col-form-label">COD</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="cod" name="cod" value="{{ $quality->cod}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="no_2" class="col-sm-5 col-form-label">NO2</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="no_2" name="no_2" value="{{ $quality->no_2}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="no_3" class="col-sm-5 col-form-label">NO3</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="no_3" name="no_3" value="{{ $quality->no_3}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="nh_2" class="col-sm-5 col-form-label">NH2</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="nh_2" name="nh_2" value="{{ $quality->nh_2}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="clorin" class="col-sm-5 col-form-label">Klorin Bebas</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="clorin" name="clorin" value="{{ $quality->clorin}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="total_fosfat" class="col-sm-5 col-form-label">Total Posfat</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="total_fosfat" name="total_fosfat" value="{{ $quality->total_fosfat}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="fenol" class="col-sm-5 col-form-label">Fenol</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="fenol" name="fenol" value="{{ $quality->fenol}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="oil" class="col-sm-5 col-form-label">Minyak & Lemak</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="oil" name="oil" value="{{ $quality->oil}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="detergent" class="col-sm-5 col-form-label">Detergen</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="detergent" name="detergent" value="{{ $quality->detergent}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="fecal_coliform" class="col-sm-5 col-form-label">Fecal Coliform</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="fecal_coliform" name="fecal_coliform" value="{{ $quality->fecal_coliform}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="total_coliform" class="col-sm-5 col-form-label">Total Coliform</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="total_coliform" name="total_coliform" value="{{ $quality->total_coliform}}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label for="cyanide" class="col-sm-5 col-form-label">Sianida</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="cyanide" name="cyanide" value="{{ $quality->cyanide}}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="h2s" class="col-sm-5 col-form-label">H2S</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" id="h2s" name="h2s" value="{{ $quality->h2s}}">
                </div>
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-primary my-1">Submit</button>
</form>