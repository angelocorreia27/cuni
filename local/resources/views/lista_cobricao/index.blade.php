@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Lista para Cobrição
@endsection


@section('main-content')
   @include('layouts.shared.alert')
 
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                 <!-- <a href="{{ url('animais/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title=""> 
	                       <i class="fa fa-plus"></i>
	                  </a>-->
	                  
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
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($animais as $animal)

				                    	<tr>						     
				                    	    <td> {{$animal->tatuagem}} </td>
				                    	    <td>{{$animal->gaiola->descricao}}</td> 
				                    		<td> {{$animal->tipo_uso}} </td>
				                    		
				                    		<td> {{$animal->banda->significado}}</td>
				                    	
				                    		<td class="actions">
						                        <a href="{{ route('reproducao.create','id_matriz='.$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a> 

						                        <a href="{{ url('ficha/'.$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-file"></i>
						                        </a>
						                          
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
