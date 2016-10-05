@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Animais
@endsection


@section('main-content')
   @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12 col-xs-6">
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
				                        <th >Gaiola</th>
				                        <th >Coelho</th>
				                        <th >Sexo</th>
				                        <th >Tatuagem</th>
				                        <th >Raça</th>
				                        <th >Ciclos</th>
				                        <th >Fornecedor</th>
				                        <th >Laparos</th>
				                        <th >Data Entrada</th>
				                        <th >Peso Entrada</th>
				                        <th >Ciclo Entrada</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($animais as $animal)
				                    	<tr>
				                    		<td>{{$animal->gaiola->descricao}}</td>
				                    		<td></td>
				                    		<td>{{$animal->sexo}}</td>
				                    		<td>{{$animal->tatuagem}}</td>
				                    		<td>{{$animal->id_raca}}</td>
				                    		<td>{{$animal->ciclo}}</td>
				                    		<td>{{$animal->id_fornecedor}}</td>
				                    		<td></td>
				                    		<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $animal->data_entrada)->format('d-m-Y') }}</td>
				                    		<td>{{$animal->id}}</td>
				                    		<td>{{$animal->ciclo_entrada}}</td>
				                    		<td class="actions">
						                        <a href="{{ route('animais.edit',$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $animal->id }}" data-name="{{ $animal->name }}" data-title="Confirm provider deletion" data-url="/animais/">
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
