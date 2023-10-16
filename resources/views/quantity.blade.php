@extends('layouts.app')

@section('content')
<div class="py-4 px-4">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h4>Data Kuantitas Air</h4>
            </div>
            <div class="col-8 justify-content-end justify-item-end d-flex pb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data</button>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Nama Lokus</th>
                <th scope="col" class="text-center">Waktu Sampling</th>
                <th scope="col" class="text-center">Tahap</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < 5; $i++) <tr>
                <th scope="row" class="text-center">{{$i+1}}</th>
                <td class="text-center">Sungai Brantas</td>
                <td class="text-center">2010</td>
                <td class="text-center">1</td>
                <td class="inline-block text-center">
                    <button class="btn bg-success"><i class="fa fa-eye"></i></button>
                    <button class="btn bg-warning"><i class="fa fa-pen"></i></button>
                    <button class="btn bg-danger"><i class="fa fa-trash"></i></button>
                </td>
                </tr>
                @endfor
        </tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-header">Masukkan Data Kuantitas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        </div>
    </div>
  </div>
</div>
@endsection