@extends('layouts.app')

@section('htmlheader_title')
	Editar
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Editar
@endsection

@section('main-content')
     <div class="row">
	    <div class="col-lg-12">
	        <div class="box box-default">
	            <div class="box-header with-border">
	              <h3 class="box-title">	              	 
	              </h3>
	              
				  <div class="pull-right box-tools">
							<a href="{{ url('cuniculas') }}" class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Voltar">
								 <i class="fa  fa-arrow-left"></i>
							</a>
					</div><!-- /. tools -->
	            </div><!-- /.box-header -->

	            <div class="box-body">

					{!! Form::model($animal, ['method'=>'PATCH',null,'route'=>['cuniculas.update', $animal->id],'id'=>'cuniculas-form'])!!}
					    @include('cuniculas.form', array('submitButtonText'=>'Edit Animal'))
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection