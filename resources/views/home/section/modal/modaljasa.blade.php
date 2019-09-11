<div id="modalhari" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Jasa Pada Hari Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Jasa</th>
                  <th>bayar</th>
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
                  <td>{{number_format($hr->bayar,2,',','.')}} @php($total += $hr->bayar)</td>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalbulan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Jasa Pada Bulan Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  
                  <th>Tanggal</th>
                  <th>bayar</th>
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

<div id="modaltahun" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Jasa Tahun Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>bayar</th>
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