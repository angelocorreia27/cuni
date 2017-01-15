@extends('layouts.app')

@section('htmlheader_title')
	Lista
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Reposição
@endsection


@section('main-content')
    @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	                  <a href="{{ url('reposicoes/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Novo">
	                       <i class="fa fa-plus"></i>
	                  </a>
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	  
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                 <table class="table table-bordered table-xs" class="tabela-sheet" id="table-reposicoes">
				                <thead>
				                    <tr>		             
				                        <th >Gaiola</th>
				                        <th >Maternidade</th>
				                        <th >Data Entrada</th>
				                        <th >Quantidade</th>
				                        <th >Dias de Fase</th>
				                        <th >Peso</th>
				                        <th >Preveção saida</th>
				                        <th >Preveção de Quantidade</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach ($reposicoes as $reposicao)
				                        <tr>
					                    	<td>{{$reposicao->gaiola->descricao}}</td>
					                    	<td>{{$reposicao->id_maternidade}}</td>
					                    	<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $reposicao->data_entrada)->format('d-m-Y') }}</td>
					                    	<td>{{$reposicao->quantidade}}</td>
					                    	<td>{{$reposicao->dias_fase}}</td>
					                    	<td>{{$reposicao->peso}}</td>
					                    	<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $reposicao->prev_saida)->format('d-m-Y') }}</td>
					                    	<td>{{$reposicao->quantidade}}</td>
					                    	<td class="actions">
						                        <a href="{{ route('reposicoes.edit',$reposicao->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                        <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $reposicao->id }}" data-name="{{ $reposicao->id }}" data-title="Confirm reposicao deletion" data-url="/reposicoes/">
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
