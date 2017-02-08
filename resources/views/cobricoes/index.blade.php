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
		.azul,.vermelho{
		    width: 25px;
		    height: 25px;
		    border-radius: 50%;
		    margin-right: 10px;
		    margin-top: -2px;
		}
		.azul{
			background: #3c8dbc;
			float: left;
		}
		.vermelho{
			background: #DD4B39;
			float: left;
		}
		.divider-legend1{
			margin-right: 10px;
            float: left;
		}
		.divider-legend2{
            float: right;
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
	                 <div class="pull-left">
	                <h1 class="box-title" class="pull-left">Mapa Cobricao:  </h1></div>
	                <div class="pull-left" style="margin-left: 10px">
	               	    <div class="divider-legend1" ></div>  
	                        <span class="azul"></span> 
	                        <span>Macho</span> 
	                    <div class="divider-legend2">
	                    	<span class="vermelho"></span> 
	                        <span>Femea</span>
	                    </div>  
	                 </div>
	               <div class="pull-left box-tools">	                                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	            
	            <div class="box-body">
	                <div class="row">
		                <div class="col-xs-12" id="map-cobricao">
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
                        </div>
			        </div>
	            </div>
	        </div>
	    </div>
	    <div id="context-menu" > 
			<ul class="dropdown-menu">
			    <li><a class='iframe' href="{{ url('/reprodutores/2/edit') }}">Regista Cobrição</a></li>
			    <li><a class='iframe' href="#">Regista Palpação</a></li>
			    <li><a class='iframe' href="#">Regista Parto</a></li>
			    <li><a class='iframe' href="#">Regista Desmame</a></li>
			    <li><a class='iframe' href="#">Regista Óbito</a></li>
			    <li><a class='iframe' href="#">Regista Abate</a></li>
			</ul>
		</div>

		{{-- <p id="menu2"><a class='iframe' href="http://wikipedia.com">Outside Webpage (Iframe)</a></p> --}}
	</div>
@endsection
