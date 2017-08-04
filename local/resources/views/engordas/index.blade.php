@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Engorda
@endsection


@section('main-content')
    @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('engordas/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
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
				                        <th >Maternidade</th>
				                        <th >Gaiola</th>
				                        <th >Data entrada</th> 
				                        <th >Quantidade</th> 
				                        <th >Qtd Obito</th> 
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($engordas as $engorda)
				                        <tr>
					                    	<td>Fêmea: {{$engorda->tatuf}}  ; Macho:{{$engorda->tatum}}</td>
					                    	<td>{{$engorda->descricao}}</td> 
					                    	<td>{{$engorda->data_entrada}}</td> 
					                    	<td>{{$engorda->quantidade}}</td>
					                    	<td>{{$engorda->qtd_obito}}</td>
					                    	
					                    	<td class="actions">
						                        <a href="{{ route('abates.create','id_engorda='.$engorda->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a> 
						                        <!--                          
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" <ata-id="{{ $engorda->id }}" data-name="{{ $engorda->descricao }}" data-title="Confirm provider deletion" data-url="/engordas/">
						                            <i class="fa fa-trash"></i>
						                        </button>  
						                        -->
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
