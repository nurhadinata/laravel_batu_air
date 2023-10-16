@extends('layouts.app')

@section('content')
<div class="py-4 px-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h4>Waktu Sampling</h4>
            </div>
            <div class="col-8 justify-content-end justify-item-end d-flex pb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#samplingAddModal">
                    Tambah data
                </button>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Waktu Sampling</th>
                <th scope="col" class="text-center">Tahap</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < sizeof($sampling_time); $i++) <tr>
                <th scope="row" class="text-center">{{$i+1}}</th>
                <td class="text-center">{{$sampling_time[$i]->time}}</td>
                <td class="text-center">{{$sampling_time[$i]->quarter}}</td>
                <td class="inline-block text-center">
                    <button class="btn bg-warning" id="update" type="button" data-toggle="modal" data-target="#samplingUpdateModal" data-id={{$i}}><i class="fa fa-pen"></i></button>
                    <button class="btn bg-danger" id="delete" type="button" data-toggle="modal" data-target="#samplingDeleteModal" data-id={{$i}}><i class="fa fa-trash"></i></button>
                </td>
                </tr>
                @endfor
        </tbody>
    </table>
</div>

<!-- Modal Tambah Sampling -->
<div class="modal fade" id="samplingAddModal" tabindex="-1" aria-labelledby="samplingAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('admin.waktu-sampling.post')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Waktu Sampling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="time" class="form-label">Tanggal Sampling</label>
                        <input type="date" class="form-control" id="time" name="time">
                    </div>
                    <div class="mb-3">
                        <label for="quarter" class="form-label">Tahap</label>
                        <select class="form-control" id="quarter" name="quarter" style="appearance:none;">
                            <option selected>Choose...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Update Sampling -->
<div class="modal fade" id="samplingUpdateModal" tabindex="-1" aria-labelledby="samplingUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('admin.waktu-sampling.update')}}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Waktu Sampling</h5>
                    <button type="button" class="close" d   ata-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <input id="updateid" name="id" hidden>
                    <div class="mb-3">
                        <label for="time" class="form-label">Tanggal Sampling</label>
                        <input type="date" class="form-control" id="timeupdate" name="time">
                    </div>
                    <div class="mb-3">
                        <label for="quarter" class="form-label">Tahap</label>
                        <select class="form-control" id="quarterupdate" name="quarter" style="appearance:none;">
                            <option selected>Choose...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Sampling -->
<div class="modal fade" id="samplingDeleteModal" tabindex="-1" aria-labelledby="samplingDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('admin.waktu-sampling.destroy')}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="hapusid" name="id" hidden>
                    <p id="hapus-body">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="hapusButton" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on('click', '#delete', function() {
        let id = $(this).attr('data-id');
        let data = <?= json_encode($sampling_time) ?>;
        if (data[id]['quality'].length > 0) {
            document.getElementById('hapus-body').innerHTML = "Terdapat data dalam waktu sampling ini, pastikan semua data pada waktu sampling sudah terhapus.";
            document.getElementById('deleteModalLabel').innerHTML = "Oops!";
            document.getElementById('hapusButton').style.display = 'none';
        } else {
            document.getElementById('hapus-body').innerHTML = "Apakah anda ingin menghapus data ini?";
            document.getElementById('deleteModalLabel').innerHTML = "Hapus Waktu Sampling";
            document.getElementById('hapusButton').style.display = 'block';
        }
        $('#hapusid').val(data[id]['id']);
    });
    $(document).on('click', '#update', function() {
        let id = $(this).attr('data-id');
        let data = <?= json_encode($sampling_time) ?>;
        $('#updateid').val(data[id]['id']);
        $('#timeupdate').val(data[id]['time']);
        $('#quarterupdate').val(data[id]['quarter']);
    });
</script>
@endsection