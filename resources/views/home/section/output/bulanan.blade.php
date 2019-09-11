@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan Bulanan</h3>
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
                <form action="{{url('/home/laporan/bulanan')}}" method="get" >
                  @csrf
                 <div class="col-md-2"></div>
                 <div class="col-md-5">
                     <select class="form-control" name="cari">
                       @foreach($datacombo as $datac)
                       <option value="{{ $datac->tahun }}-{{ sprintf('%02s', $datac->bulan) }}" <?php if($datac->tahun.'-'.sprintf('%02s', $datac->bulan) == $tangal){ echo 'selected="selected"'; }?>>{{ sprintf("%02s", $datac->bulan) }}-{{ $datac->tahun }}</option>
                       @endforeach
                     </select>
                 </div>
                 <div class="col-md-2">
                   <input type="submit" name="btncari" value="Submit" class="btn btn-info">
                   <input type="submit" name="btncetak" value="Cetak" class="btn btn-info">
                 </div>
                </form><br><br><br>
 <div class="panel panel-default tabs">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">All</a></li>
            <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Pemerintah / Swasta Program</a></li>
        </ul>
        <div class="panel-body tab-content">
            <div class="tab-pane active" id="tab1">
          <div class="col-md-12">
          	<br>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
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
               <tr >
               		<td >{{$no++}}</td>
                  <td>{{date('d F Y', strtotime($data->tglbayar))}}</td>
               		<td @if($data->costem == 'pemeswas') style="background:blue; color:#fff" @endif>{{$data->nama}}</td>
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
               <tr>
               	<td colspan="5"></td>
               	<td>Pengeluaran Bulan Ini</td>
               	<td>
               		@php($cekpen = DB::table('pengeluaran_models')->where('tanggal','LIKE','%'.$tangal.'%')->get())
               		@php($ttlcekpen = 0)
               		@foreach($cekpen as $cp)
               			@php($ttlcekpen += $cp->total)
               		@endforeach
               		{{"Rp " . number_format($ttlcekpen,2,',','.')}}
               	</td>
               </tr>
               <tr>
               	<td colspan="5"></td>
               	<td>Gaji Bulan Ini</td>
               	<td>
               		@php($cekga = DB::table('penggajian_models')->where('tglbayar','LIKE','%'.$tangal.'%')->get())
               		@php($ttlcekga = 0)
               		@foreach($cekga as $cga)
               			@php($ttlcekga += $cga->jumlah)
               		@endforeach
               		{{"Rp " . number_format($ttlcekga,2,',','.')}}
               	</td>
               </tr>
               <tr>
               	<td colspan="5"></td>
               	<td><center><b>Hasil Bulan ini</b></center></td>
               	<td>
               		@php($hasil = 0)
               		@if($total == 0)
               		 @php($hasil =  $ttlcekpen - $ttlcekga)
               		@elseif($ttlcekpen == 0)
               		 @php($hasil =  $total - $ttlcekga)
               		@elseif($ttlcekga == 0)
               		 @php($hasil = $total - $ttlcekpen)
               		@else
               		 @php($hasil =  $total - $ttlcekpen - $ttlcekga)
               		@endif
               		<b>{{"Rp " . number_format($hasil,2,',','.')}}</b>
               	</td>
               </tr>
               <tr>
               	<td colspan="5"></td>
               	<td><center><b>Status</b></center></td>
               	<td>
               		<b>
               		@if($hasil > 0)
               		 Anda Mendapatkan Laba
               		@else
               		 Anda Mengalami Kerugian
               		@endif
               		</b>
               	</td>
               </tr>
              </tbody>
            </table>
          </div>
     
          </div>
          <div class="tab-pane" id="tab2">
                        <div class="col-md-12">
            <br>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <th>bayar</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total1=0)
                @foreach($cekdatakusus as $data1)
               <tr >
                  <td >{{$no++}}</td>
                  <td>{{date('d F Y', strtotime($data->tglbayar))}}</td>
                  <td>{{$data1->nama}}</td>
                  <td>{{$data1->type}}</td>
                  <td>{{$data1->status}}</td>
                  <td>
                    {{$data->keterangan}}
                  </td>
                  <td>{{number_format($data1->jlmbayar,2,',','.')}} @php($total1 += $data1->jlmbayar)</td>
               </tr>
               @endforeach
               <tr>
                <th colspan="6"><center>Total</center></th>
                <th>{{"Rp " . number_format($total1,2,',','.')}}</th>
               </tr>
               <tr>
                <td colspan="5"></td>
                <td>Pengeluaran Bulan Ini</td>
                <td>
                  @php($cekpen1 = DB::table('pengeluaran_models')->where('tanggal','LIKE','%'.$tangal.'%')->where('level',1)->get())
                  @php($ttlcekpen1 = 0)
                  @foreach($cekpen1 as $cp1)
                    @php($ttlcekpen1 += $cp1->total)
                  @endforeach
                  {{"Rp " . number_format($ttlcekpen1,2,',','.')}}
                </td>
               </tr>
               <tr>
                <td colspan="5"></td>
                <td><center><b>Hasil Bulan ini</b></center></td>
                <td>
                  @php($hasil1 = 0)
                  @if($total1 == 0)
                   @php($hasil1 = $total1 - $ttlcekpen1)
                  @else
                   @php($hasil1 =  $total1 - $ttlcekpen1)
                  @endif
                  <b>{{"Rp " . number_format($hasil1,2,',','.')}}</b>
                </td>
               </tr>
               <tr>
                <td colspan="5"></td>
                <td><center><b>Status</b></center></td>
                <td>
                  <b>
                  @if($hasil1 > 0)
                   Anda Mendapatkan Laba
                  @else
                   Anda Mengalami Kerugian
                  @endif
                  </b>
                </td>
               </tr>
              </tbody>
            </table>
          </div>
          </div>               
      </div>
        </div>                       


            </div>
        </div>
    </div>
  </div>
</div>
@endsection