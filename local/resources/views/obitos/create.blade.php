@extends('layouts.app')

@section('htmlheader_title')
	Obito
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Novo
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
							<a href="{{ url('obitos') }}" class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Voltar">
								 <i class="fa  fa-arrow-left"></i>
							</a>
					</div><!-- /. tools -->
	            </div><!-- /.box-header -->

	            <div class="box-body">
	                {!! Form::open(['route'=>'obitos.store', 'id'=>'obitos-form','files'=>true]) !!}
					    @include('obitos.form', array('submitButtonText'=>'Add Obito'))
					{!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	</div>
@endsection
