@extends('home.template')
@section('mainhome')
<div class="container-fluid">
	<div class="row">
	    <div class="col-md-3">
	        <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-users"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">{{@count($dasles)}}</div>
                    <div class="widget-title">Les</div>
                    <div class="widget-subtitle">Bulan Ini</div>
                </div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
            </div>
	    </div>
	    <div class="col-md-3">
	        <div class="widget widget-default widget-item-icon" >
	            <div class="widget-item-left">
	                <span class="fa fa-star"></span>
	            </div>                             
	            <div class="widget-data">
	                <div class="widget-int num-count">{{@count($dasjasa)}}</div>
	                <div class="widget-title">Jasa</div>
	                <div class="widget-subtitle">Bulan Ini</div>
	            </div>      
	            <div class="widget-controls">                                
	                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
	            </div>
	        </div>     
	    </div>
	    <div class="col-md-3">
	        <div class="widget widget-default widget-item-icon" >
	            <div class="widget-item-left">
	                <span class="fa fa-code"></span>
	            </div>
	            <div class="widget-data">
	                <div class="widget-int num-count">{{@count($dasprog)}}</div>
	                <div class="widget-title">Pembuatan Program</div>
	                <div class="widget-subtitle">Bulan Ini</div>
	            </div>
	            <div class="widget-controls">                                
	                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
	            </div>                            
	        </div>  
	    </div>
	    <div class="col-md-3">
	        <div class="widget widget-default widget-padding-sm">
	            <div class="widget-big-int plugin-clock">00:00</div>
	            <div class="widget-subtitle plugin-date">Loading...</div>
	            <div class="widget-controls">                                
	                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
	            </div>                            
	            <div class="widget-buttons widget-c3">
	                <div class="col">
	                    <a href="#"><span class="fa fa-clock-o"></span></a>
	                </div>
	                <div class="col">
	                    <a href="#"><span class="fa fa-bell"></span></a>
	                </div>
	                <div class="col">
	                    <a href="#"><span class="fa fa-calendar"></span></a>
	                </div>
	            </div>                            
	        </div>   
	    </div>
	</div>
	<div class="col-md-9" style="background: #fff">
		<div class="col-md-4"><br>
      <h3><i class="fa fa-bar-chart-o"></i> Chart bulan</h3></div>
		<div class="col-md-6" >
			<br>
			<form action="{{url('/home')}}" method="get">
				@csrf
				<select class="form-control" name="cari" onchange="this.form.submit()">
					@php($bulan = '')
					@foreach($datacombo as $datac)
            			<option value="{{ $datac->tahun }}-{{ sprintf('%02s', $datac->bulan) }}" <?php if($datac->tahun.'-'.sprintf('%02s', $datac->bulan) == $cekbulanvalue) echo 'selected="selected"'; ?>>
            				  @if($datac->bulan == '1')
			                    @php($bulan = 'Januari')
			                  @elseif($datac->bulan == '2')
			                    @php($bulan = 'Februari')
			                  @elseif($datac->bulan == '3')
			                    @php($bulan = 'Maret')
			                  @elseif($datac->bulan == '4')
			                    @php($bulan = 'April')
			                  @elseif($datac->bulan == '5')
			                    @php($bulan = 'Mai')
			                  @elseif($datac->bulan == '6')
			                    @php($bulan = 'Juni')
			                  @elseif($datac->bulan == '7')
			                    @php($bulan = 'Juli')
			                  @elseif($datac->bulan == '8')
			                    @php($bulan = 'Agustus')
			                  @elseif($datac->bulan == '9')
			                    @php($bulan = 'Sebtember')
			                  @elseif($datac->bulan == '10')
			                    @php($bulan = 'Oktober')
			                  @elseif($datac->bulan == '11')
			                    @php($bulan = 'November')
			                  @elseif($datac->bulan == '12')
			                    @php($bulan = 'Desember')
			                  @endif
            				{{ $bulan }} {{ $datac->tahun }}
            			</option>
        			@endforeach
				</select>
			</form>
		</div>
		<div class="col-md-3"></div>
		<br><br><br>
		<div class="col-md-12">
	    <div id="chart_div" style="width:100%;height:365px"></div>
		</div>
        <script type="text/javascript">
         google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawTrendlines);

        function drawTrendlines() {
          var data = new google.visualization.DataTable();
          data.addColumn('date', 'Perhari');
          data.addColumn('number', 'Les');
          data.addColumn('number', 'Jasa');
          data.addColumn('number', 'Pembuatan Program');
          data.addRows([
            <?php foreach($cekbulan as $cb) { ?>
            <?php 
                $les = DB::table('keuangan_models')->where('tgl_bayar','LIKE','%'.$cb->tgl.'%')->where('jenis','les')->get() ;
                $jasa = DB::table('keuangan_models')->where('tgl_bayar','LIKE','%'.$cb->tgl.'%')->where('jenis','jasa')->get() ;
                $pprogram = DB::table('keuangan_models')->where('tgl_bayar','LIKE','%'.$cb->tgl.'%')->where('jenis','pprogram')->get() ;
                $tahun = date('Y', strtotime($cb->tgl));
                $bulan = date('m', strtotime($cb->tgl)) - 1;
                $hari  = date('d', strtotime($cb->tgl));
            ?>
            [new Date(<?= $tahun.', '.$bulan.', '.$hari ?>),  <?= count($les) ?>,  <?= count($jasa) ?>,  <?= count($pprogram) ?>],
            <?php } ?>
          ]);
          var options = {
             hAxis: {
              title: 'Tanggal',
              format: 'd-MMM-yy',
            },
            vAxis: {
              title: 'Jumlah', minValue: 0,
            },
            
        colors: ['#4285f4','#e01b1b', '#1caf9a'],
        pointSize: 7,
        lineWidth: 3,
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }
      </script>
      <!--  -->
          <div class="col-md-4"><br>
      <h3><i class="fa fa-bar-chart-o"></i> Chart Tahun</h3></div>
    <div class="col-md-6" >
      <br>
      <form action="{{url('/home')}}" method="get">
        @csrf
        <select class="form-control" name="caritahun" onchange="this.form.submit()">
          @foreach($datacombotahun as $datactt)
              <option value="{{ $datactt->tahun }}" <?php if($datactt->tahun == $cektahunvalue) echo 'selected="selected"'; ?>>
                  {{ $datactt->tahun }}
              </option>
          @endforeach
        </select>
      </form>
    </div>
    <div class="col-md-3"></div>
    <br><br><br>
    <div class="col-md-12">
      <div id="chart_div1" style="width:100%;height:365px"></div>
    </div>
        <script type="text/javascript">
         google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawTrendlines1);

        function drawTrendlines1() {
          var data1 = new google.visualization.DataTable();
          data1.addColumn('date', 'bulan');
          data1.addColumn('number', 'Les');
          data1.addColumn('number', 'Jasa');
          data1.addColumn('number', 'Pembuatan Program');
          data1.addRows([
            <?php foreach($cektahun as $ct) { ?>
            <?php 
                $lestahun = DB::table('keuangan_models')
                ->where('tgl_bayar','LIKE','%'.$ct->tahun.'-'.sprintf('%02s', $ct->bulan).'%')
                ->where('jenis','les')
                ->get() ;
                $jasatahun = DB::table('keuangan_models')
                ->where('tgl_bayar','LIKE','%'.$ct->tahun.'-'.sprintf('%02s', $ct->bulan).'%')
                ->where('jenis','jasa')
                ->get() ;
                $pprogramtahun = DB::table('keuangan_models')
                ->where('tgl_bayar','LIKE','%'.$ct->tahun.'-'.sprintf('%02s', $ct->bulan).'%')
                ->where('jenis','pprogram')
                ->get() ;
                $bulantt = $ct->bulan - 1;
            ?>
            [new Date(<?= $ct->tahun.', '.$bulantt ?>),  <?= count($lestahun) ?>,  <?= count($jasatahun) ?>,  <?= count($pprogramtahun) ?>],
            <?php } ?>
          ]);
          var options = {
             hAxis: {
              title: 'Bulan',
              format: 'MMM-yy',
            },
            vAxis: {
              title: 'Jumlah', minValue: 0,
            },
            
        colors: ['#4285f4','#e01b1b', '#1caf9a'],
        pointSize: 7,
        lineWidth: 3,
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart.draw(data1, options);
        }
      </script>
	</div>
	<div class="col-md-3">
			<div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading ui-draggable-handle">
               <center><b>Notivication Les </b></center>
            </div>
            <div class="panel-body">
            </div>
            <div class="panel-body list-group">
                <a href="{{url('/home/keuangan/les')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Hari 
                  @if(count($kridithariles) > 0)
                    <span class="badge badge-danger">{{count($kridithariles)}}</span>
                  @endif
                </a>
                <a href="{{url('/home/keuangan/les')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Bulan
                  @if(count($kriditbulanles) > 0)
                    <span class="badge badge-danger">{{count($kriditbulanles)}}</span>
                  @endif
                </a>                                
                <a href="{{url('/home/keuangan/les')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Tahun 
                  @if(count($kridittahunles) > 0)
                    <span class="badge badge-danger">{{count($kridittahunles)}}</span>
                  @endif
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading ui-draggable-handle">
               <center><b>Notivication Pembuatan Program </b></center>
            </div>
            <div class="panel-body">
            </div>
            <div class="panel-body list-group">
                <a href="{{url('/home/keuangan/program')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Hari 
                  @if(count($kridithariprog) > 0)
                    <span class="badge badge-danger">{{count($kridithariprog)}}</span>
                  @endif
                <a href="{{url('/home/keuangan/program')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Bulan
                	@if(count($kriditbulanprog) > 0)
                    <span class="badge badge-danger">{{count($kriditbulanprog)}}</span>
                    @endif
                </a>                                
                <a href="{{url('/home/keuangan/program')}}" class="list-group-item"><span class="fa fa-circle-o"></span> Tahun 
                  @if(count($kridittahunprog) > 0)
                    <span class="badge badge-danger">{{count($kridittahunprog)}}</span>
                  @endif
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <iframe data-aa="1218352" src="//ad.a-ads.com/1218352?size=200x90" scrolling="no" style="width:200px; height:90px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
    </div>
	</div>
</div>
@endsection