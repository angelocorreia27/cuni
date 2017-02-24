@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Raças
@endsection


@section('main-content')
    @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('racas/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                  </a>
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	  
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="table-racas">
				                <thead>
				                    <tr>		                        
				                        <th >Codigo</th>
				                        <th >Descrição</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($racas as $raca)
				                        <tr>
					                    	<td>{{$raca->codigo}}</td>
					                    	<td>{{$raca->descricao}}</td>
					                    	<td class="actions">
						                        <a href="{{ route('racas.edit',$raca->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $raca->id }}" data-name="{{ $raca->name }}" data-title="Confirm provider deletion" data-url="/racas/">
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
