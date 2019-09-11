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
                <div class="pull-left">
                  <span>Laporan Kridit:</span>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#modalkridithari">Hari
                  @if(count($kridithari) > 0)
                    <span class="badge">{{count($kridithari)}}</span>
                  @endif
                  </button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#modalkriditbulan">Bulan
                  @if(count($kriditbulan) > 0)
                    <span class="badge">{{count($kriditbulan)}}</span>
                  @endif
                  </button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#modalkridittahun">Tahun 
                  @if(count($kridittahun) > 0)
                    <span class="badge">{{count($kridittahun)}}</span>
                  @endif
                  </button>
                </div>
              	<div class="pull-right">
                  <span>Laporan Tunai:</span>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modaltunaihari">Hari</button>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modaltunaibulan">Bulan</button>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modaltunaitahun">Tahun</button>
              	</div>
              </div> <br>
 	   			<div class=" col-md-6">
 	   				<form action="{{url('home/keuangan/les')}}" method="post">
 	   				@csrf
 	   				<label for="nmkom">Nama</label>
 	   				<input type="text" name="nama" id="nmkom" placeholder="Enter Nama" class="form-control">
 	   				<label for="jenis">Jenis Les</label>
 	   				<input type="text" name="keterangan" id="jenis" placeholder="Enter Jenis Aplikasi" class="form-control">
            <label for="nohp">No Hp.</label>
            <input type="number" name="nohp" id="nohp" placeholder="Enter Nomor Hp" class="form-control">
 	   				<label for="status">Status</label>
 	   				<select name="status" id="status" class="form-control">
 	   					<option value="tunai">Tunai</option>
 	   					<option value="kridit">Kridit</option>
 	   				</select>
 	   				<label for="ttlhar">Harga</label>
 	   				<input type="text" name="harga" id="rupiah"  placeholder="Enter Total Harga" class="form-control">
            <label for="bayar">Bayar</label>
            <input type="text"  name="bayar" id="bayar" placeholder="Enter Total Bayar" class="form-control">
 	   				<label for="tgltransaksi">TGL Transaksi</label>
 	   				<input type="date" name="tgl_bayar" id="tgltransaksi" placeholder="Enter TGL Transaksi" class="form-control"> <br>
 	   				<input type="submit" value="Submit" class="btn btn-danger">
 	   			</form>
 	   			</div>
          <div class="col-md-6">
            <h3>Hari Ini</h3>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Les</th>
                  <th>Status</th>
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
                  <td>
                    @if($hr->status == 'kridit')
                    <span class="btn btn-danger">{{$hr->status}}</span>
                    @else
                    <span class="btn btn-success">{{$hr->status}}</span>
                    @endif
                  </td>
                  <td>{{number_format($hr->jlmbayar,2,',','.')}} @php($total += $hr->jlmbayar)</td>
                  <td>
                    <form method="post" action="{{url('/home/keuangan/les/'.$hr->id_trans.'/delete')}}">
                      @csrf @method('delete')
                      <a href="{{url('/home/keuangan/les/'.$hr->id_trans.'/edit')}}" class="btn btn-info">Edit</a>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="4"><center>Total</center></th>
                  <th>{{"Rp " . number_format($total,2,',','.')}}</th>
                </tr>
              </tbody>
            </table>
          </div>
            </div>
        </div>
    </div>
  </div>
  @include('home.section.modal.modalles')
</div>
@endsection