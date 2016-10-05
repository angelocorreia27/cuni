@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Gaiolas
@endsection


@section('main-content')
    @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12 col-xs-6">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('gaiolas/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                  </a>
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	  
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="table-gaiolas">
				                <thead>
				                    <tr>		                        
				                        <th >Codigo</th>
				                        <th >Descrição</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($gaiolas as $gaiola)
				                        <tr>
					                    	<td>{{$gaiola->codigo}}</td>
					                    	<td>{{$gaiola->descricao}}</td>
					                    	<td class="actions">
						                        <a href="{{ route('gaiolas.edit',$gaiola->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $gaiola->id }}" data-name="{{ $gaiola->name }}" data-title="Confirm provider deletion" data-url="/gaiolas/">
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
