@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan Harian</h3>
                <ul class="panel-controls" style="margin-top: 2px;">
                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                    </ul>
                </li>
            </ul>
            </div>
            <div class="panel-body">
            <form action="{{url('/home/laporan/harian')}}" method="get" >
             @csrf
            <div class="col-md-3">
              <label>Dari :</label>
              <input type="date" name="dari" class="form-control" value="{{$dari}}">
            </div>
            <div class="col-md-3">
            		 <label>Sampai :</label>
              <input type="date" name="sampai" class="form-control" value="{{$sampai}}">
            </div>
            <div class="col-md-2"><br>
            	<input type="submit" name="btncari" value="Submit" class="btn btn-info">
            	<input type="submit" name="btncetak" value="Cetak" class="btn btn-info">
            </div>
           </form>
          <div class="col-md-12">
          	<br>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tangal</th>
                  <th>Nama</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <th>bayar</th>
                </tr>
              </thead>
              <tbody>
              	@php($no=1)
              	@php($total=0)
              	@foreach($cekdata as $data)
               <tr>
               		<td>{{$no++}}</td>
                  <td>{{date('d F Y', strtotime($data->tglbayar))}}</td>
               		<td>{{$data->nama}}</td>
               		<td>{{$data->type}}</td>
               		<td>{{$data->status}}</td>
               		<td>
										@if($data->costem == 'pemeswas')
										Pemerinatahan / Swasta ({{$data->keterangan}})
										@else
										{{$data->keterangan}}
										@endif
									</td>
               		<td>{{number_format($data->jlmbayar,2,',','.')}} @php($total += $data->jlmbayar)</td>
               </tr>
               @endforeach
               <tr>
               	<th colspan="6"><center>Total</center></th>
               	<th>{{"Rp " . number_format($total,2,',','.')}}</th>
               </tr>
              </tbody>
            </table>
          </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
