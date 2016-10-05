@extends('layouts.app')

@section('htmlheader_title')
	Gaiola
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
							<a href="{{ url('gaiolas') }}" class="btn btn-primary btn-sm" role="button" data-toggle="tooltip" title="Voltar">
								 <i class="fa  fa-arrow-left"></i>
							</a>
					</div><!-- /. tools -->
	            </div><!-- /.box-header -->

	            <div class="box-body">
	                {!! Form::open(['route'=>'gaiolas.store', 'id'=>'gaiolas-form','files'=>true]) !!}
					    @include('gaiolas.form', array('submitButtonText'=>'Add Gaiola'))
					{!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	</div>
@endsection
