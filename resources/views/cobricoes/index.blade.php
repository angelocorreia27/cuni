@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Mapa de Cobrição
@endsection

@section('main-content')
   <style type="text/css">
		#map-cobricao #type-cobricao{
			margin-top: 50px;
		}
		.loader {
		  border: 16px solid #f3f3f3;
		  border-radius: 50%;
		  border-top: 16px solid #3498db;
		  width: 120px;
		  height: 120px;
		  -webkit-animation: spin 2s linear infinite;
		  animation: spin 2s linear infinite;
		  position: fixed;
	      top: 50%;
	      left: 50%;
	      margin-left: -50px; /* half width of the spinner gif */
          margin-top: -50px; /* half height of the spinner gif */
          z-index:1234;
          overflow: auto;
		}

		@-webkit-keyframes spin {
		  0% { -webkit-transform: rotate(0deg); }
		  100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}
   </style>
   @include('layouts.shared.alert')
	<div class="loader" style="display:none;"></div>
	<div class="row">
	    <div class="col-lg-12">
	        <input type="hidden" name="" id="input-max-macho" class="form-control" value="{{$max_reprodutores}}">
	        <input type="hidden" name="" id="input-max-femea" class="form-control" value="{{$max_matrizes}}">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">Mapa de Cobrição: <small>Azul: Macho, Vermelho: Femea</small></h3>
	               <div class="pull-left box-tools">
	                    {{-- <a href="{{ url('animais/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                    </a> --}}	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	            
	            <div class="box-body">
	                <div class="row">
		                <div class="col-xs-12" id="map-cobricao">
		                    {{-- <div class="col-xs-1 type-cobricao" style="    margin-top: 50px">
		                    	Macho
		                    </div>
		                    <div class="col-xs-11"> --}}
	                            <ul class="nav nav-justified list-inline list-dark">
		                           {{-- 	<li class="list-inline-item bg-info" style="padding-left: 0; padding-right: 0;">
		                           	    <a href="#" class="">Banda 1</a>
		                           	    <ul class="todo-list">
			                           	   	<li class="">Item 1</li>
			                           	   	<li class="">Item 2</li>
			                           	   	<li class="">Item 3</li>
		                           	    </ul>
		                           	</li>
		                           	<li class="list-inline-item bg-info" style="padding-left: 0; padding-right: 0;">
		                           	    <a href="#">Banda 2</a>
	                                    <ul class="todo-list">
		                           	   	<li class="">Item 1</li>
		                           	   	<li class="">Item 2</li>
		                           	   	<li class="">Item 3</li>
		                           	   </ul>
		                           	</li>
		                           	<li class="list-inline-item bg-info" style="padding-left: 0; padding-right: 0;">
		                           	     <a href="#">Banda 3</a>
	                                    <ul class="todo-list">
		                           	   	<li class="">Item 1</li>
		                           	   	<li class="">Item 2</li>
		                           	   	<li class="">Item 3</li>
		                           	   </ul>
		                           	</li>  --}}
					            </ul>
					        {{-- </div> --}}
                        </div>
			               {{--  <table class="table table-bordered table-xs"  id="table-mapa-cobricao">
				                <thead>
				                     <tr>
				                        <th></th>
				                        @foreach ($bandas as $banda)
				                        	 <th>{{$banda->significado}}</th>
				                        @endforeach					                       
				                    </tr> 
				                </thead>
				                <tbody>
				                    {{- @foreach ($reprodutores as $reprodutor)	
				                        <tr>
				                            <td>Machos</td>			                    	
					                        <td>{{$reprodutor->tatuagem}}</td>
					                        <td>{{$reprodutor->tatuagem}}</td>
					                        <td>{{$reprodutor->tatuagem}}</td>
				                        </tr>
				                    @endforeach
				                    
				                    @foreach ($matrizes as $matriz)	
				                        <tr>
				                            <td>Femeas</td>			                    	
					                        <td>{{$matriz->tatuagem}}</td>
				                        </tr>
				                    @endforeach 
				                    @foreach ($animais as $animal)
				                    	<tr>
				                    	    <td>{{$animal->tatuagem}}</td>
				                    	    <td>{{$animal->gaiola->descricao}}</td> 
				                    		<td>{{$animal->tipo_uso}}</td>
				                    		<td>{{$animal->banda->significado}}</td>
				                    		<td>
					                    		@if ($animal->sexo == 0)
					                    			Femea
					                    		@else
					                    			Macho
					                    		@endif
				                    		</td>
				                    		
				                    		<td>{{$animal->raca->descricao}}</td>
				                    		<td>{{$animal->ciclo}}</td>

				                    		<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $animal->data_entrada)->format('d-m-Y') }}</td>

				                    		<td>{{$animal->peso_entrada}}</td>
				                    		<td class="actions">
						                        <a href="{{ route('animais.edit',$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                         <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $animal->id }}" data-name="{{ $animal->id }}" data-title="Confirm animal deletion" data-url="/animais/">
						                            <i class="fa fa-trash"></i>
						                        </button> 
						                    </td>
				                    	</tr>
				                    @endforeach
				                </tbody>                                     
				            </table>  --}}
			            </div>
			        </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
