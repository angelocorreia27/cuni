 @extends('layouts.app')

 @section('htmlheader_title')
	home
@endsection 

 @section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection 

 @section('contentheader_description')
  Control panel
@endsection
@section('main-content')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-default">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	              <div class="pull-left box-tools">
	                   
	              </div><!-- /. tools -->

	             <div class="col-lg-3 col-md-4 col-sm-6">
		             <div class="form-group form-group-sm">
		            {!! Form::label('charts', 'Gráfico:') !!}
			         <select name="charts" id="id_charts" class="form-control">
				         <option value="PG" select="selected">
				         Performance diagnostico de gestação	
				         </option>
				         <option value="PD" >
				         Performance de desmame	
				         </option>
				         <option value="PF" >
				         Performance fases	
				         </option>
				         <option value="PP" >
				         Performance produção	
				         </option>
				         
			        </select>

	   				</div>
   				</div>

	            </div><!-- /.box-header -->

	            <div class="box-body">

					<div id="pop_div"></div>
					@if ($charts == "PD")
					    <?= $lava->render('AreaChart', 'Population', 'pop_div') ?>
					@endif
					@if ($charts == "PG")
					    <?= $lavaDiag->render('ColumnChart', 'Diagnosticos', 'pop_div') ?>
					@endif

					@if ($charts == "PF")
					    <?= $lavaFases->render('BarChart', 'fases', 'pop_div') ?>
					@endif

					@if ($charts == "PP")
					    <?= $lavaProd->render('ColumnChart', 'prod', 'pop_div') ?>
					@endif
					
	            </div>
	   
	        </div>
	    </div>

	</div>
@endsection
