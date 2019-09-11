@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">update data</h3>
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
 	   				<form action="{{url('home/keuangan/'.$lokasi.'/'.$cekdata->id_trans.'/edit')}}" method="post">
 	   				@csrf @method('PUT')
 	   				<label for="nmkom">Nama</label>
 	   				<input type="text" name="nama" id="nmkom"  class="form-control" value="{{ $cekdata->nama }}">
 	   				<label for="jenis">Keterangan</label>
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
   				<label for="ttlhar">Harga</label>
   				<input type="text" name="harga" id="rupiah" value="{{$cekdata->harga }}" class="form-control">
            <label for="tgltransaksi">TGL Transaksi</label>
   				<input type="date" name="tgl_bayar" value="{{$cekdata->tgl_bayar}}" id="tgltransaksi" placeholder="Enter TGL Transaksi" class="form-control">
            <br>
   				<input type="submit" value="Submit" class="btn btn-danger">
 	   			</form>
 	   			</div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection