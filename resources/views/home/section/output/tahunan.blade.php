@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan Tahunan</h3>
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
            <form action="{{url('/home/laporan/tahunan')}}" method="get" >
             @csrf
            <div class="col-md-2"></div>
            <div class="col-md-5">
            		<select class="form-control" name="cari">
            			@foreach($datacombo as $datac)
            			<option value="{{ $datac->tahun }}">{{ $datac->tahun }}</option>
            			@endforeach
            		</select>
            </div>
            <div class="col-md-5">
            	<input type="submit" name="btncari" value="Submit" class="btn btn-info">
            	<input type="submit" name="btncetak" value="Cetak" class="btn btn-info">
            </div>
           </form>
          <div class="col-md-12">
          	<br>
            <table class="table table-striped table-bordered">
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
                <td colspan="2">
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
                    <b>{{$bulan}} {{$cd->tahun}}</b>
                  </div>
                  @php($bul = date('Y-m', strtotime($cd->tahun.'-'.sprintf("%02s",$cd->bulan))))
                </td>
              </tr>
              <tr>
                <td>Penghasilan</td>
                <td>
                  @php($cekbulan = DB::table('trans_models')->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
                  ->GroupBy(DB::raw('YEAR(tglbayar)'))
                  ->select(DB::raw('YEAR(tglbayar) as tahun,sum(jlmbayar) as totalgr'))
                 ->where('trans_models.tglbayar', 'LIKE', '%'.$bul.'%')
                 ->first())
                 @php($total = $cekbulan->totalgr)
                 {{"Rp " . number_format($total,2,',','.')}}
                </td>
              </tr>
              <tr>
                <td>Pengeluaran</td>
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
              </tr>
              <tr>
                <td>Penggajian</td>
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
              </tr>
              <tr>
                <td><center><b>Jumlah :</b></center></td>
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
                    <b>{{"Rp " . number_format($hasil,2,',','.')}} @php($hhasil += $hasil)</b>
                </td>
              </tr>
              @endforeach
              <tr>
                <td colspan="2"> <hr></td>
              </tr>
              <tr>
                <td><div align="right"><b>Hasil :</b></div></td>
                <td><div ><b>{{"Rp " . number_format($hhasil,2,',','.')}}</b></div></td>
              </tr>
            </table>
          </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection