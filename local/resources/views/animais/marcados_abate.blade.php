@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Marcados Para Abate
@endsection


@section('main-content')
   @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">

	                  
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
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($animais as $animal)
				                    	<tr>
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
				                    	
				                    		<td class="actions">
						                        <a href="{{ route('animais.edit',$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>  
						                        <a href="{{ url('ficha/'.$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-file"></i>
						                        </a>
						                        <a href="{{ route('obitos.create',$animal->id) }}" class="btn btn-warning btn-xs", data-remote='true'])>      <i class="fa fa-fire"></i>
						                        </a>    
						                         <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $animal->id }}" data-name="{{ $animal->tatuagem }}" data-title="Confirm animal deletion" data-url="/animais/">
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
