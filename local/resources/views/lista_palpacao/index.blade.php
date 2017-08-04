@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Palpação
@endsection


@section('main-content')
   @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <!-- <a href="{{ url('reproducao/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                  </a> -->
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	            
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="table-stock">
				                <thead>
				                    <tr>		                        
				                        <th >Matriz</th>
				                        <th >Reprodutor</th>
				                        <th >Gaiola</th>
				                         <th >Data Cobertura</th>
				                        <th >Previsão de Parto</th>		                     
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                     @foreach ($reprodutores as $reproducao) 
				                    	<tr>
				                    		<td>{{$reproducao->tatuf}}</td>
				                    		<td>{{$reproducao->tatum}}</td>
				                    		<td>{{$reproducao->descricao}}</td>

				                    		 <td>{{$reproducao->data_cobertura }}</td>

				                    		<td> {{$reproducao->prev_parto }} </td>
				                    		
				                    		 <td class="actions">
						                        <a href="{{ route('reproducao.edit',$reproducao->id) }}" class="btn btn-primary btn-xs"])>      <i class="fa fa-edit"></i>
						                        </a>  

						                        <a href="{{ url('ficha/'.$reproducao->id_matriz) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-file"></i>
						                        </a>

						                         <!-- <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $reproducao->id }}" data-name="{{ $reproducao->id }}" data-title="Confirm reproducao deletion" data-url="/reproducao/">
						                            <i class="fa fa-trash"></i>
						                        </button>  -->
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
