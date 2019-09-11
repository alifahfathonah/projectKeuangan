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
            <form action="{{url('/home/keuangan/'.$cekdata->id.'/editpenggajian')}}" method="post">
              @csrf
              @method('put')
              <div class="container-fluid">
                <label>Keteranggan</label>
                <input type="text" name="keteranggan" class="form-control" value="{{$cekdata->keteranggan}}">
                <label>Tanggal</label>
                <input type="date" name="tglbayar" class="form-control" value="{{$cekdata->tglbayar}}">
                <label>Jumlah</label>
                <input type="text" id="rupiah" name="jumlah" class="form-control" value="{{$cekdata->jumlah}}"><br>
                <input type="submit" value="Submit" class="btn btn-danger">
              </div>
            </form>
          </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection