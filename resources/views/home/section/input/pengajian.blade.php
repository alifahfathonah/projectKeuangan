@extends('home.template')
@section('mainhome')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form Penggajian</h3>
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
          <div class=" col-md-6">
            <form action="{{url('home/keuangan/penggajian')}}" method="post">
              @csrf
              <div class="container-fluid">
                <label>Keterangan</label>
                <input type="text" name="keteranggan" class="form-control" placeholder="Enter Keterangan">
                <label>Tanggal</label>
                <input type="date" name="tglbayar" class="form-control" placeholder="Enter Tanggal">
                <label>Jumlah</label>
                <input type="text" name="jumlah" class="form-control" placeholder="Enter Jumlah" id="rupiah"><br>
                <input type="submit" value="Submit" class="btn btn-danger">
              </div>
            </form>

          </div>
           
          <div class=" col-md-12">
             <div class="container-fluid"><br><br>
            <table class="table table-striped table-bordered datatable" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Keterangan</th>
                  <th>Tanggal </th>
                  <th>Jumlah</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
               @php($no = 1)
               @foreach($datapgn as $data)
               <tr>
                 <td>{{$no++}}</td>
                 <td>{{$data->keteranggan}}</td>
                 <td>{{ date('d-m-Y', strtotime($data->tglbayar)) }}</td>
                 <td>{{"Rp " . number_format($data->jumlah,2,',','.')}}</td>
                 <td>
                   <a href="{{url('/home/keuangan/'.$data->id.'/editpenggajian')}}" class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{$data->id}}">Hapus</a>
                   <div id="modalhapus{{$data->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-trash-alt"></i></h4>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <h2>Apakah Anda Yakin Ingin Menghapus : {{$data->keteranggan}} ?</h2>
                               <form action="{{url('/home/keuangan/'.$data->id.'/editpenggajian')}}" method="post">
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