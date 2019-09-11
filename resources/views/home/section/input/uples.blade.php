@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Les</h3>
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
              <div class="container-fluid">

 	   			<div class=" col-md-6">
 	   				<form action="{{url('home/keuangan/'.$cekdata->id_trans.'/editles')}}" method="post">
 	   				@csrf @method('PUT')
 	   				<label for="nmkom">Nama</label>
 	   				<input type="text" name="nama" id="nmkom"  class="form-control" value="{{ $cekdata->nama }}">
 	   				<label for="jenis">Jenis Les</label>
 	   				<input type="text" name="keterangan" id="jenis" placeholder="Enter Jenis Aplikasi" class="form-control" value="{{$cekdata->keterangan}}">
 	   				<label for="status">Status</label>
 	   				<select name="status" id="status" class="form-control">
              @if($cekdata->status == 'kridit')
 	   					<option value="tunai">Tunai</option>
 	   					<option value="kridit" selected>Kridit</option>
              @else
              <option value="tunai" selected>Tunai</option>
              <option value="kridit">Kridit</option>
              @endif
 	   				</select>
 	   				<label for="ttlhar">Jumlah Kridit yang tertinggal</label>
 	   				@php
 	   				$ttl=0;
 	   				$cekjlm = DB::table('trans_models')
 	   				->where('id_trans', 'LIKE', '%'.$cekdata->id_trans.'%')
 	   				->get()
 	   				@endphp
 	   				@foreach($cekjlm as $jlm)
 	   					@php($ttl += $jlm->jlmbayar)
 	   				@endforeach
 	   				<span class="form-control">
 	   				@php($jlmnn=$cekdata->harga - $ttl)
 	   				{{"Rp " . number_format($jlmnn,2,',','.')}}
 	   			    </span>
		            <label for="bayar">Bayar</label>
		            <input type="text" name="bayar" id="rupiah" placeholder="Enter Total Bayar" class="form-control">
		            <label for="tgltransaksi">TGL Transaksi</label>
 	   				<input type="date" name="tgl_bayar" id="tgltransaksi" placeholder="Enter TGL Transaksi" class="form-control">
		            <br>
 	   				<input type="submit" value="Submit" class="btn btn-danger">
 	   			</form>
 	   			</div>
          <div class="col-md-6">
            <h3>History</h3>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tgl Pembayaran</th>
                  <th>Jumlah Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                 @php($no=1)
                @php($total=0)
                @foreach($hariini as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{ date('d F Y', strtotime($hr->tglbayar)) }}</td>
                  <td>{{number_format($hr->jlmbayar,2,',','.')}} @php($total += $hr->jlmbayar)</td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="2"><center>Total</center></th>
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