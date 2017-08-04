@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Abate
@endsection


@section('main-content')
   @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('abates/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
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
				                        <th >Engorda</th>
				                        <th >Animal</th>
				                        <th >Data Abate</th>
				                        <th >Peso</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($abates as $abate)
				                    	<tr>
				                    		<td>@if(isset($abate->engorda->gaiola->descricao))
					                    			{{$abate->engorda->gaiola->descricao}} - 
					                    			{{$abate->engorda->data_entrada}}
					                    		@endif
				                    		</td>

				                    		<td>@if(isset($abate->animal->tatuagem))
					                    			{{$abate->animal->tatuagem}}
					                    		@endif
				                    		</td>

				                    		<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $abate->data_abate)->format('d-m-Y') }}</td>
				                    		<td>{{$abate->peso}}</td>
											<!--
				                    		<td class="actions">
						                        <a href="{{ route('abates.edit',$abate->id) }}" class="btn btn-primary btn-xs", data-remote='false'])>      <i class="fa fa-edit"></i>
						                        </a>      
						           
						                    </td>
						                    -->
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
