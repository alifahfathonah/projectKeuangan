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
<h2 align="center">Laporan Tahunan</h2>
 <table border="1" cellpadding="0" cellspacing="0" align="center" style="width: 100%">
    <tr style="background: #dfdfdf">
      <th>No</th>
      <th>Bulan</th>
      <th>Penghasilan</th>
      <th>Pengeluaran</th>
      <th>Penggajian</th>
      <th>Total</th>
    </tr>
     <?php 
  $bulan = '';
  $total = 0;
  $total2 = 0;
  $total3 = 0;
  $no = 1;
  $hhasil = 0;
   ?>
  @foreach($cekdata as $cd)
    <tr>
      <td><center>{{$no++}}</center></td>
    <td >
      @if($cd->bulan == '1')
        @php($bulan = 'Januari')
      @elseif($cd->bulan == '2')
        @php($bulan = 'Februari')
      @elseif($cd->bulan == '3')
        @php($bulan = 'Maret')
      @elseif($cd->bulan == '4')
        @php($bulan = 'April')
      @elseif($cd->bulan == '5')
        @php($bulan = 'Mai')
      @elseif($cd->bulan == '6')
        @php($bulan = 'Juni')
      @elseif($cd->bulan == '7')
        @php($bulan = 'Juli')
      @elseif($cd->bulan == '8')
        @php($bulan = 'Agustus')
      @elseif($cd->bulan == '9')
        @php($bulan = 'Sebtember')
      @elseif($cd->bulan == '10')
        @php($bulan = 'Oktober')
      @elseif($cd->bulan == '11')
        @php($bulan = 'November')
      @elseif($cd->bulan == '12')
        @php($bulan = 'Desember')
      @endif
      <div align="">
        {{$bulan}} {{$cd->tahun}}
      </div>
      @php($bul = date('Y-m', strtotime($cd->tahun.'-'.sprintf("%02s",$cd->bulan))))
    </td>
    <!--  -->
    <td>
      @php($cekbulan = DB::table('trans_models')->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
      ->GroupBy(DB::raw('YEAR(tglbayar)'))
      ->select(DB::raw('YEAR(tglbayar) as tahun,sum(jlmbayar) as totalgr'))
     ->where('trans_models.tglbayar', 'LIKE', '%'.$bul.'%')
     ->first())
     @php($total = $cekbulan->totalgr)
     {{"Rp " . number_format($total,2,',','.')}}
    </td>
    <!--  -->
    <td>
    @php($pengeluaran = DB::table('pengeluaran_models')
     ->GroupBy(DB::raw('YEAR(tanggal)'))
     ->select(DB::raw('YEAR(tanggal) as tahun,sum(total) as totalpen'))
     ->where('tanggal', 'LIKE', '%'.$bul.'%')
     ->first())
     @if($pengeluaran == null)
      @php($total2 = 0)
      @else
      @php($total2 = $pengeluaran->totalpen)
      @endif
     {{"Rp " . number_format($total2,2,',','.')}}
    </td>
    <!--  -->
     <td>
      @php($penggajian = DB::table('penggajian_models')
      ->GroupBy(DB::raw('YEAR(tglbayar)'))
      ->select(DB::raw('YEAR(tglbayar) as tahun,sum(jumlah) as totalga'))
     ->where('tglbayar', 'LIKE', '%'.$bul.'%')
     ->first())
     @if($penggajian == null)
      @php($total3 = 0)
      @else
       @php($total3 = $penggajian->totalga)
      @endif
     {{"Rp " . number_format($total3,2,',','.')}}
    </td>
    <!--  -->
    <td>
     @php($hasil = 0)
    @if($total == 0)
     @php($hasil =  $total2 - $total3)
    @elseif($total2 == 0)
     @php($hasil =  $total - $total3)
    @elseif($total3 == 0)
     @php($hasil = $total - $total2)
    @else
     @php($hasil =  $total - $total2 - $total3)
    @endif
        {{"Rp " . number_format($hasil,2,',','.')}} @php($hhasil += $hasil)
    </td>
    </tr>
  @endforeach
  <tr>
    <td colspan="5"><div align="center"><b>Hasil </b></div></td>
    <td><div ><b>{{"Rp " . number_format($hhasil,2,',','.')}}</b></div></td>
  </tr>
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