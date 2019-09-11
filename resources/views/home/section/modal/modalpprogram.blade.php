<!-- modal tunai -->
<div id="modaltunaihari" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Tunai Pada Hari Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Program</th>
                  <th>Tanggal Bayar</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($lunashari as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama}}</td>
                  <td>{{$hr->keterangan}}</td>
                  <td>{{ date('d-m-Y', strtotime($hr->tgl_lunas))}}</td>
                  <td>@php($ttl=0)
                    @php($cekjlm = DB::table('trans_models')
                    ->where('id_trans', 'LIKE', '%'.$hr->id_trans.'%')
                    ->get())
                    @foreach($cekjlm as $jlm)
                      @php($ttl += $jlm->jlmbayar)
                    @endforeach
                    {{ $ttl }}
                    @php($total += $ttl)
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modaltunaibulan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Tunai Pada Bulan Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal </th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($lunasbulan as $hr)
                <tr>
                  <td>{{$no++}} </td>
                 <td>{{$hr->bulan }} - {{$hr->tahun}}</td>
                 <td>
                  {{ number_format($hr->totalgr,2,',','.')}}
                  @php($total += $hr->totalgr)
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="2"><center>Total</center></th>
                  <th>{{"Rp " . number_format($total,2,',','.')}}</th>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modaltunaitahun" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Tunai Tahun Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($lunastahun as $hr)
                <tr>
                  <td>{{$no++}} </td>
                 <td>{{$hr->tahun}}</td>
                 <td>
                  {{ number_format($hr->totalgr,2,',','.')}}
                  @php($total += $hr->totalgr)
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="2"><center>Total</center></th>
                  <th>{{"Rp " . number_format($total,2,',','.')}}</th>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end modal tunai -->

<!-- modal tridit -->
<div id="modalkridithari" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Kridit Pada Hari Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Program</th>
                  <th>Terakhir dibayar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($kridithari as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama}}</td>
                  <td>{{$hr->keterangan}}</td>
                  <td>{{ date('d-m-Y', strtotime($hr->tgl_kridit))}}</td>
                  <td>
                  	<a href="{{ url('/home/keuangan/'.$hr->id_trans.'/editprogram')}}" class="btn btn-info">Bayar</a>
                    /home/keuangan/{id}/editprogram
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalkriditbulan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Kridit Pada Bulan Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Program</th>
                  <th>Terakhir dibayar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($kriditbulan as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama}}</td>
                  <td>{{$hr->keterangan}}</td>
                  <td>{{ date('d-m-Y', strtotime($hr->tgl_kridit))}}</td>
                  <td>
                    <a href="{{ url('/home/keuangan/'.$hr->id_trans.'/editprogram')}}" class="btn btn-info">Bayar</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalkridittahun" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pembuatan Program Kridit Tahun Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Program</th>
                  <th>Terakhir dibayar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($kridittahun as $hr)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$hr->nama}}</td>
                  <td>{{$hr->keterangan}}</td>
                  <td>{{ date('d-m-Y', strtotime($hr->tgl_kridit))}}</td>
                  <td>
                    <a href="{{ url('/home/keuangan/'.$hr->id_trans.'/editprogram')}}" class="btn btn-info">Bayar</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end modal kridit -->