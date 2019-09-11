@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Jasa</h3>
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
              	<div class="pull-right">
              		<span>Laporan :</span>
              		<button class="btn btn-info" data-toggle="modal" data-target="#modalhari">Hari</button>
              		<button class="btn btn-info" data-toggle="modal" data-target="#modalbulan">Bulan</button>
              		<button class="btn btn-info" data-toggle="modal" data-target="#modaltahun">Tahun</button>
              	</div>
              </div>
 	   			<div class=" col-md-6">
 	   				<form action="{{url('home/keuangan/jasa')}}" method="post">
 	   				@csrf
 	   				<label for="nmkom">Nama</label>
 	   				<input type="text" name="nama" id="nmkom" placeholder="Enter Nama" class="form-control">
 	   				<label for="ket">Keterangan</label>
 	   				<select name="keterangan" id="ket" class="form-control">
 	   					<option value="">==Pilih==</option>
 	   					<option value="Instalasi Laptop">Instalasi Laptop</option>
 	   					<option value="Revisi Program">Revisi Program</option>
 	   					<option value="Konsultasi">Konsultasi</option>
 	   					<option value="Hosting">Hosting</option>
 	   					<option value="Perpanjan Hosting">Perpanjang Hosting</option>
 	   					<option value="SEO">SEO</option>
 	   					<option value="Playstore">Playstore</option>
 	   				</select>
            <label for="nohp">No Hp.</label>
            <input type="number" name="nohp" id="nohp" placeholder="Enter Nomor Hp" class="form-control">
 	   				<label for="ttlhar">Bayar</label>
 	   				<input type="text" name="harga" id="rupiah" placeholder="Enter Total Harga" class="form-control">
 	   				<label for="tgltransaksi">TGL Transaksi</label>
 	   				<input type="date" name="tgl_bayar" id="tgltransaksi" placeholder="Enter TGL Transaksi" class="form-control"> <br>
 	   				<input type="submit" value="Submit" class="btn btn-primary">
 	   			</form>
 	   			</div>
          <div class="col-md-6">
            <h3>Hari Ini</h3>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Jasa</th>
                  <th>bayar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($hariini as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama}}</td>
                  <td>{{$hr->keterangan}}</td>
                  <td>{{number_format($hr->bayar,2,',','.')}} @php($total += $hr->bayar)</td>
                  <td>
                    <form method="post" action="{{url('/home/keuangan/jasa/'.$hr->id_trans.'/delete')}}">
                      @csrf @method('delete')
                      <a href="{{url('/home/keuangan/jasa/'.$hr->id_trans.'/edit')}}" class="btn btn-info">Edit</a>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="3"><center>Total</center></th>
                  <th>{{"Rp " . number_format($total,2,',','.')}}</th>
                </tr>
              </tbody>
            </table>
          </div>
            </div>
        </div>
      
    </div>
  </div>
  @include('home.section.modal.modaljasa');
</div>
@endsection