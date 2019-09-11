<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Bulanan</title>
	<script type="text/javascript">
		 window.print();
	</script>
</head>
<body>
<img src="{{ asset('/img/kopsurat.png')}}" style="width: 100%;height: 120px;">
<h2 align="center">Laporan Bulanan</h2>
<p align="right">Bulan : {{date('F-Y', strtotime($tangal))}}</p>
<table cellpadding="0" border="1" cellspacing="0" style="width: 100%;" align="center">
  <thead>
    <tr style="background: #dfdfdf">
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
   <tr>
   		<td><center>{{$no++}}</center></td>
        <td>{{date('d F Y', strtotime($data->tglbayar))}}</td>
   		<td>{{$data->nama}}</td>
   		<td>{{$data->type}}</td>
   		<td><center>{{$data->status}}</center></td>
   		<td>
   			<center>
	        @if($data->costem == 'pemeswas')
	        Pemerinatahan / Swasta ({{$data->keterangan}})
	        @else
	        {{$data->keterangan}}
	        @endif
	        </center>
         </td>
   		<td>{{number_format($data->jlmbayar,2,',','.')}} @php($total += $data->jlmbayar)</td>
   </tr>
   @endforeach
   <tr>
   	<th colspan="6"><center>Total</center></th>
   	<td><b>{{"Rp " . number_format($total,2,',','.')}}</b></td>
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
<br><br><br>
<div style="overflow:hidden;">
  <div style="float: right; width: 400px">
    <center>Padang, {{date('d F Y')}}<br>
    Hormat Kami
    <br><br><br><br><br>
<b><u>FERRI ACHMAD EFFINDRI, M.KOM</u><br>
DIREKTUR</b>
  </center>
  </div>
</div>
</body>
</html>
