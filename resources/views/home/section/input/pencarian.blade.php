@extends('home.template')
@section('mainhome')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form Pencarian data</h3>
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
           
          <div class=" col-md-12">
             <div class="container-fluid"><br><br>
            <table class="table table-striped table-bordered datatable" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis </th>
                  <th>Keterangan </th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
               @php($no = 1)
               @foreach($cekdata as $data)
               <tr>
                 <td>{{$no++}}</td>
                 <td>{{$data->nama}}</td>
                 <td>{{$data->type}}</td>
                 <td>
                   @if($data->costem == 'pemeswas')
                    <span style="background: blue; color: #fff">Pemerinatahan / Swasta ({{$data->keterangan}}) </span>
                    @else
                    {{$data->keterangan}}
                    @endif
                 </td>
                 <td>
                  @if($data->status == 'kridit')
                    <span class="btn btn-danger">{{$data->status}}</span>
                    @if($data->jenis == 'les')
                    <a href="{{url('/home/keuangan/'.$data->id_trans.'/editles')}}" class="btn btn-info">Bayar</a>
                    @else
                     <a href="{{ url('/home/keuangan/'.$data->id_trans.'/editprogram')}}" class="btn btn-success">Bayar</a>
                    @endif
                    @else
                    <span class="btn btn-success">Lunas</span>
                    @endif
                    <button class="btn btn-info" data-toggle="modal" data-target="#modalhistory{{$data->id_trans}}">History</button>
                     <div id="modalhistory{{$data->id_trans}}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">History {{$data->nama}}</h4>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <table class="table">
                                <tr>
                                  <td>Nama</td>
                                  
                                  <td>{{$data->nama}}</td>
                                </tr>
                                <tr>
                                  <td>Type</td>
                                  
                                  <td>{{$data->type}}</td>
                                </tr>
                                <tr>
                                  <td>Keterangan</td>
                                  
                                  <td>{{$data->keterangan}}</td>
                                </tr>
                                <tr>
                                  <td>Harga</td>
                                  
                                  <td>{{"Rp " . number_format($data->harga,2,',','.')}}</td>
                                </tr>
                                <tr>
                                  <td>Tanggal Bayar Pertama</td>
                                  
                                  <td>{{date('d F Y', strtotime($data->tgl_bayar))}}</td>
                                </tr>
                                <tr>
                                  <td>Tanggal Lunas</td>
                                  
                                  <td>
                                    @if($data->tgl_lunas == null)
                                      -
                                    @else
                                      {{date('d F Y', strtotime($data->tgl_lunas))}}
                                    @endif
                                  </td>
                                </tr>
                                 <tr>
                                  <td>Status</td>
                                  
                                  <td>
                                     @if($data->status == 'kridit')
                                    <span class="btn btn-danger">{{$data->status}}</span>
                                    @else
                                    <span class="btn btn-success">{{$data->status}}</span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>No Hp</td>
                                  
                                  <td>{{$data->nohp}}</td>
                                </tr>
                              </table>
                               <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Tgl Pembayaran</th>
                                      <th>Jumlah Pembayaran</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     @php($noo=1)
                                    @php($total=0)
                                    @php($hariini  = DB::table('trans_models')->where('id_trans', $data->id_trans)->get())
                                    @foreach($hariini as $hr)
                                    <tr>
                                      <td>{{$noo++}}</td>
                                      <td>{{ date('d F Y', strtotime($hr->tglbayar)) }}</td>
                                      <td>{{number_format($hr->jlmbayar,2,',','.')}} @php($total += $hr->jlmbayar)</td>
                                      <td>
                                        <form action="{{url('/home/keuangan/trans/'.$hr->id)}}" method="post">
                                          @csrf @method('delete')
                                          <a href="{{url('/home/keuangan/trans/'.$hr->id)}}" class="btn btn-info">Edit</a>
                                          <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
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
                 </td>
                 <td>
                    @php($lokasi = '')
                    @if($data->jenis == 'pprogram')
                        @php($lokasi = 'program')
                    @else
                        @php($lokasi = $data->jenis)
                    @endif
                      <a href="{{url('/home/keuangan/'.$lokasi.'/'.$data->id_trans.'/edit')}}" class="btn btn-info">Edit</a>
                      <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{$data->id_trans}}">Hapus</a>
                   <div id="modalhapus{{$data->id_trans}}" class="modal fade" role="dialog">
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
                              <form method="post" action="{{url('/home/keuangan/'.$lokasi.'/'.$data->id_trans.'/delete')}}">
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
              </tbody>
            </table>
        </div>
          </div>
           
            </div>
        </div>
    </div>
  </div>
</div>
@endsection