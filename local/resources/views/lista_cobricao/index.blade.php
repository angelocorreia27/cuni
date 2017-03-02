@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Lista Cobrição
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
 
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('animais/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                  </a>
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	            
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="table-stock">
				                <thead>
				                    <tr>	
				                        <th >Tatuagem</th>	                        
				                        <th >Gaiola</th>
				                        <th >Uso</th>
				                        <th >Banda</th>
				                        <th >Sexo</th>				                        
				                        <th >Raça</th>				                      
				                        <th >Data Entrada</th>
				                        <th >Peso Entrada</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($animais as $animal)

				                    	<tr>
												
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

				                    	    <td> {{$animal->tatuagem}} </td>
				                    	    <td>{{$animal->gaiola->descricao}}
				                    	    </td> 
				                    		<td> {{$animal->tipo_uso}} </td>
				                    		<td> {{$animal->banda->significado}}
				                    		</td>
				                    		<td>

					                    		 @if ($animal->sexo == 0)
					                    			Femea
					                    		@else
					                    			Macho
					                    		@endif 
				                    		</td>
				                    		
				                    		<td>{{$animal->raca->descricao}} </td>
				                    	

				                    		<td> {{ $animal->data_entrada }}
				                    		</td>

				                    		<td> {{$animal->peso_entrada}}

				                    		</td>
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
				            </table> 
			            </div>

			            

			        </div>
	            </div>
	        </div>
	    </div>
	    
	</div>

@endsection
