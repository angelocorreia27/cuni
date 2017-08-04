@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Desmame
@endsection


@section('main-content')
    @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                 <!--  <a href="{{ url('maternidades/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Novo">
	                       <i class="fa fa-plus"></i>
	                  </a> -->
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	  
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="table-maternidades">
				                <thead>
				                    <tr>		                        
				                        <th >Reproducao</th>
				                        <th >Gaiola</th>
				                        <th >Data de Parto</th>
				                        <th >Nados Vivos</th>
				                        <th >Nados Mortos</th>
				                        <th >Qtd. Obitos</th>
				                        <th >Previsão desmame</th>
				                        
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($maternidades as $maternidade)
				                        <tr>
					                    	<td>Fêmea: {{$maternidade->tatuf}}  ; Macho:{{$maternidade->tatum}}</td>
					                    	<td>{{$maternidade->descricao }}</td>
					                    	<td>{{$maternidade->data_parto }}</td>
					                     	<td>{{$maternidade->n_vivos}}</td>
					                    	<td>{{$maternidade->n_mortos}}</td> 
					                    	<td>{{$maternidade->qtd_obito }}</td>
					                    	<td>{{$maternidade->data_prev_desmame }}</td> 
					                        
					                    	<td class="actions">
						                        <a href="{{ route('engordas.create','id_maternidade='.$maternidade->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>
						                        <a href="{{ url('ficha/'.$maternidade->id_matriz) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-file"></i>
						                        </a> 

						                           <!--                        
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $maternidade->id }}" data-name="{{ $maternidade->id }}" data-title="Confirm maternidade deletion" data-url="/maternidades/">
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
