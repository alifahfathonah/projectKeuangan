@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Update Pengeluaran</h3>
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
 	   				<form action="{{url('home/pengeluaran/'.$data->id.'/edit')}}" method="post">
 	   				@csrf @method('put')
 	   				<label for="nmkom">Nama Komponen</label>
 	   				<input type="text" name="nama_kpn" id="nmkom" placeholder="Enter Nama Komponen" class="form-control" value="{{ $data->nama_kpn }}">
 	   				<label for="jlmkom">Jumlah Komponen</label>
 	   				<input type="number" name="jumlah" id="jlmkom" placeholder="Enter Jumlah Komponen" value="{{$data->jumlah}}" class="form-control">
 	   				<label for="ttlhar">Total Harga</label>
 	   				<input type="text" name="total" value="{{$data->total}}" id="rupiah" placeholder="Enter Total Harga" class="form-control">
 	   				<label for="tgltransaksi">TGL Transaksi</label>
 	   				<input type="date" name="tanggal" id="tgltransaksi" value="{{$data->tanggal}}" placeholder="Enter TGL Transaksi" class="form-control"> <br>
 	   				<input type="submit" value="Submit" class="btn btn-primary">
 	   				</form>
 	   			</div>

            </div>
        </div>
    </div>
  </div>
</div>
@endsection
