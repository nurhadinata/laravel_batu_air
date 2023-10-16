<?php

use Illuminate\Support\Facades\URL;
?>
@extends('layouts.app')

@section('content')
<div class="py-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{Route('admin.index')}}">Kualitas</a></li>
            <li class="breadcrumb-item active"><?=explode('-',$sampling_time->time)[0]?> tahap <?=$sampling_time->quarter?></li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h4>Data Kualitas Air</h4>
            </div>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center align-middle">No</th>
                    <th scope="col" class="text-center align-middle">Nama Lokus</th>
                    <th scope="col" class="text-center text-nowrap align-middle">Waktu Sampling</th>
                    <th scope="col" class="text-center align-middle">Tahap</th>
                    <th scope="col" class="text-center">Temperatur<br><span style="font-weight: normal;">(°C)</span></th>
                    <th scope="col" class="text-center align-middle">pH</th>
                    <th scope="col" class="text-center">DHL<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">TDS<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">TSS<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">DO<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">BOD<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">COD<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">NO2<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">NO3<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">NH2<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">Klorin<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">T-P<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">Fenol<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">Minyak<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center">Detergen<br><span style="font-weight: normal;">(mg/L)</span></th>
                    <th scope="col" class="text-center text-nowrap  align-middle">Fecal Coliform</th>
                    <th scope="col" class="text-center text-nowrap  align-middle">Total Coliform</th>
                    <th scope="col" class="text-center  align-middle">Sianida</th>
                    <th scope="col" class="text-center  align-middle">H2S</th>
                    <th scope="col" class="text-center  align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($quality as $value)

                <th scope="row" class="text-center">{{$counter++}}</th>
                <td class="text-center text-nowrap">{{$value->monitoring_point->monitoring_point}}</td>
                <td class="text-center">{{explode('-',$value->sampling_time->time)[0]}}</td>
                <td class="text-center">{{$value->sampling_time->quarter}}</td>
                <td class="text-center">{{$value->temperature}}</td>
                <td class="text-center">{{$value->ph}}</td>
                <td class="text-center">{{$value->dhl}}</td>
                <td class="text-center">{{$value->tds}}</td>
                <td class="text-center">{{$value->tss}}</td>
                <td class="text-center">{{$value->do}}</td>
                <td class="text-center">{{$value->bod}}</td>
                <td class="text-center">{{$value->cod}}</td>
                <td class="text-center">{{$value->no_2}}</td>
                <td class="text-center">{{$value->no_3}}</td>
                <td class="text-center">{{$value->nh_2}}</td>
                <td class="text-center">{{$value->clorin}}</td>
                <td class="text-center">{{$value->total_fosfat}}</td>
                <td class="text-center">{{$value->fenol}}</td>
                <td class="text-center">{{$value->oil}}</td>
                <td class="text-center">{{$value->detergent}}</td>
                <td class="text-center">{{$value->fecal_coliform}}</td>
                <td class="text-center">{{$value->total_coliform}}</td>
                <td class="text-center">{{$value->cyanide}}</td>
                <td class="text-center">{{$value->h2s}}</td>
                <td class="text-nowrap text-center">
                    <button class="btn bg-warning" data-toggle="modal" id="largeButton" data-target="#largeModal" data-attr="{{ route('admin.edit', $value->id) }}" title="Edit Project">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button class="btn btn-danger" data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('admin.delete', $value->id) }}" title="Delete Project">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });
    </script>
    
    <div class="modal fade bd-example-modal-lg" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="largeBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // display a modal (small modal)
        $(document).on('click', '#largeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#largeModal').modal("show");
                    $('#largeBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });
    </script>
</div>

</div>
</div>
</div>
@endsection