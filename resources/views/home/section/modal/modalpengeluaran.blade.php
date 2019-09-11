<div id="modalhari" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Laporan Pengeluaran Pada Hari Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama komponen</th>
                  <th>Jumlah Komponen</th>
                  <th>Total</th>
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
        <h4 class="modal-title">Laporan Pengeluaran Pada Bulan Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama komponen</th>
                  <th>Jumlah Komponen</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($cekbulan as $hr)
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
        <h4 class="modal-title">Laporan Pengeluaran Tahun Ini</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama komponen</th>
                  <th>Jumlah Komponen</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php($no=1)
                @php($total=0)
                @foreach($cektahun as $hr)
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
