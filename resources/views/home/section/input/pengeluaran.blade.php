@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Pengeluaran</h3>
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
                  <span>Laporan Pengeluaran :</span>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modalhari">Hari</button>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modalbulan">Bulan</button>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modaltahun">Tahun</button>
                </div>
              </div> <br>
 	   			<div class=" col-md-6">
 	   				<form action="{{url('home/pengeluaran')}}" method="post">
 	   				@csrf
 	   				<label for="nmkom">Nama Komponen</label>
 	   				<input type="text" name="nama_kpn" id="nmkom" placeholder="Enter Nama Komponen" class="form-control">
            <label for="nmkom">Level</label>
           <select name="level" class="form-control" required>
             <option value="">==PIlih==</option>
             <option value="0">Umum</option>
             <option value="1">Pemerintah / Swasta</option>
           </select>
 	   				<label for="jlmkom">Jumlah Komponen</label>
 	   				<input type="number" name="jumlah" id="jlmkom" placeholder="Enter Jumlah Komponen" class="form-control">
 	   				<label for="ttlhar">Total Harga</label>
 	   				<input type="text" name="total" id="rupiah" placeholder="Enter Total Harga" class="form-control">
 	   				<label for="tgltransaksi">TGL Transaksi</label>
 	   				<input type="date" name="tanggal" id="tgltransaksi" placeholder="Enter TGL Transaksi" class="form-control"> <br>
 	   				<input type="submit" value="Submit" class="btn btn-primary">
 	   				</form>
 	   			</div>
          <div class="col-md-6">
            <h3>Hari Ini</h3>
             <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama komponen</th>
                  <th>Jumlah Komponen</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($cekhari as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama_kpn}}</td>
                  <td>{{$hr->jumlah}}</td>
                  <td>{{number_format($hr->total,2,',','.')}} @php($total += $hr->total)</td>
                  <td>
											  <a href="{{url('/home/pengeluaran/'.$hr->id.'/edit')}}" class="btn btn-info">Edit</a>
	                     <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modaledit{{$hr->id}}">Hapus</a>
	                    <div id="modaledit{{$hr->id}}" class="modal fade" role="dialog">
	                       <div class="modal-dialog modal-lg">

	                         <!-- Modal content-->
	                         <div class="modal-content">
	                           <div class="modal-header">
	                             <button type="button" class="close" data-dismiss="modal">&times;</button>
	                             <h4 class="modal-title"><i class="fa fa-trash-alt"></i></h4>
	                           </div>
	                           <div class="modal-body">
	                             <div class="container-fluid">
	                               <h2>Apakah Anda Yakin Ingin Menghapus data ini ?</h2>
																 <form action="{{url('/home/pengeluaran/'.$hr->id.'/delete')}}" method="post">
																	 @csrf @method('delete')
	                                  <button type="submit" class="btn btn-danger">Hapus</button>
	                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                                </form>
	                             </div>
	                           </div>
	                           <div class="modal-footer">
	                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                           </div>
	                         </div>

	                       </div>
	                     </div>
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
   @include('home.section.modal.modalpengeluaran')
</div>
@endsection
