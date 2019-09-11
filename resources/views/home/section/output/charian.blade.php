<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Harian</title>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
<img src="{{ asset('/img/kopsurat.png')}}" style="width: 100%;height: 120px;">
<h2 align="center">Laporan Harian</h2>
<p align="right">Tanggal : {{date('d-F-Y', strtotime($tangal))}}</p>
<table cellpadding="0" border="1" cellspacing="0" style="width: 100%;" align="center">
  <thead>
    <tr style="background: #dfdfdf">
      <th>No</th>
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
   		<td>{{$data->nama}}</td>
   		<td>{{$data->type}}</td>
   		<td><center>{{$data->status}}</center></td>
   		<td><center>
				@if($data->costem == 'pemeswas')
				Pemerinatahan / Swasta ({{$data->keterangan}})
				@else
				{{$data->keterangan}}
				@endif
			</center></td>
   		<td><center>{{number_format($data->jlmbayar,2,',','.')}} @php($total += $data->jlmbayar)</center></td>
   </tr>
   @endforeach
   <tr>
   	<th colspan="5"><center>Total</center></th>
   	<th><center>{{"Rp " . number_format($total,2,',','.')}}</center></th>
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
