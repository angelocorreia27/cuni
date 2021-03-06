@extends('layouts.app')

@section('htmlheader_title')
	Raca
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
							<a href="{{ url('racas') }}" class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Voltar">
								 <i class="fa  fa-arrow-left"></i>
							</a>
					</div><!-- /. tools -->
	            </div><!-- /.box-header -->

	            <div class="box-body">

					{!! Form::model($raca, ['method'=>'PATCH',null,'route'=>['racas.update', $raca->id],'id'=>'racas-form'])!!}
					    @include('racas.form', array('submitButtonText'=>'Edit Raça'))
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection