@extends($layout)

@section('htmlheader_title')
	Reposicao
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Editar
@endsection

@section('main-content')
    @include('layouts.shared.alert')
     <div class="row">
	    <div class="col-lg-12">
	        <div class="box box-default">
	            <div class="box-header with-border">
	              <h3 class="box-title">	              	 
	              </h3>
	              
				  <div class="pull-right box-tools">
				        
						
					</div><!-- /. tools -->

	            <div class="box-body">
					{!! Form::model($reposicao, ['method'=>'PATCH','popup'=>'true','route'=>['reposicoes.update', $reposicao->id],'id'=>'reposicoes-form'])!!}
					    @include('reposicoes.form', array('submitButtonText'=>'Editar'))
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection