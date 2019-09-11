@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
    <div class="col-md-12">
       <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Setting</h3>
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
              <div class="col-md-6">
                <form action="{{url('/home/setting')}}" method="post">
                  @csrf @method('put')
                  <label>Nama</label>
                  <input type="text" name="name" value="{{ auth()->user()->name}}" required class="form-control">
                  <label>Email</label>
                  <input type="email" name="email" value="{{ auth()->user()->email}}" required class="form-control">
                  <label>Status</label>
                  <span class="form-control">{{auth()->user()->level}}</span>
                  <label>Password</label>
                  <input type="password" name="password" class="form-control"><br><br>
                  <input type="submit" value="Update" class="btn btn-danger">
                </form>
              </div>
            </div>
        </div>
      
    </div>

  </div>
</div>
@endsection