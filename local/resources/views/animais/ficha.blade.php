@extends('layouts.app')

@section('htmlheader_title')
	Ficha 
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Ficha 
@endsection


@section('main-content')
   @include('layouts.shared.alert')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	               <div class="pull-left box-tools">
	               	<!--
	                  <a href="{{ url('animais/create') }}"  class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="">
	                       <i class="fa fa-plus"></i>
	                  </a>
	                  -->
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	            
	            <div class="box-body">
	                <div class="row">
			            <div class="col-xs-12 table-responsive">
			                <table class="table table-bordered table-xs" class="tabela-sheet" id="animal-ficha">
				                <thead>
				                    <tr>	
				                        <th >Tatuagem</th>	                        
				                        <th >Gaiola</th>
				                        <th >Data Nascimento</th>
				                        <th >Banda</th>
				                        <th >Pai</th>
				                        <th >Mae</th>
				                        <th></th>
				                    </tr>
				                </thead>
				                <tbody>
				                    	<tr>
				                    	    <td>{{$animal->tatuagem}}</td>
				                    	    <td>{{$animal->gaiola->descricao}}</td> 
				                    	    <td>{{$animal->data_nascimento}}</td>
				                    		<td>{{$animal->banda->significado}}</td>
				                    		<td>@if(isset($animal->id_reposicao) && ($animal->id_reposicao !=0 ))
					                    			{{$animal->reposicao->maternidade->reproducao->pai->tatuagem}}

					                    		@endif 
				                    		</td>
				                    		<td>@if(isset($animal->id_reposicao) && ($animal->id_reposicao !=0 ))
					                    			{{$animal->reposicao->maternidade->reproducao->mae->tatuagem}}

					                    		@endif 
					                    	</td>
				                    		<td class="actions">
				                    			<!--
						                        <a href="{{ route('animais.edit',$animal->id) }}" class="btn btn-primary btn-xs", data-remote='true'])>      <i class="fa fa-edit"></i>
						                        </a>                           
						                         <button type="button" class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $animal->id }}" data-name="{{ $animal->id }}" data-title="Confirm animal deletion" data-url="/animais/">
						                            <i class="fa fa-trash"></i>
						                        </button> 
						                        -->
						                    </td>
				                    	</tr>
				                </tbody>                                     
				            </table> 

							&nbsp;&nbsp;<strong>Cobrições:</strong><br>
							<br>
				            <table class="table table-bordered table-xs" class="tabela-sheet" id="reproducao-ficha">
				                <thead>
				                    <tr>	
											@if($animal->sexo==0)
				                    	    <th >Macho</th>
				                    	    @else
				                    	    	<th >Fêmea</th>
				                    	    @endif

				                        <th >Data Cobertura</th>	                        
				                        <th >Diagnostico</th>
				                        <th >Aborto</th>
				                        <th >Data Parto</th>
				                        <th >Nados Vivos</th>
				                        <th >Nados Mortos</th>
				                        <th >Total Desmamados</th>
				                     
				                    </tr>
				                </thead>
				                <tbody>
				                @foreach ($reproducoes as $reproducao)
				                    	<tr>
				                    	    <td>
											@if($animal->sexo==0)
				                    	    {{$reproducao->pai->tatuagem}}
				                    	    @else
				                    	    	{{$reproducao->mae->tatuagem}}
				                    	    @endif

				                    	    </td>
				                    	    <td>{{$reproducao->data_cobertura}}</td> 
				                    	    <td>{{$reproducao->diagnostico}}</td>
				                    		<td>{{$reproducao->aborto}}</td>
				                    		<td>{{$reproducao->data_parto}}</td>
				                    		<td>{{$reproducao->n_vivos}}</td>
				                    		<td>{{$reproducao->n_mortos}}</td>
				                    		<td>{{$reproducao->quantidade}}</td>
				                    		<td></td>
				                    		
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
