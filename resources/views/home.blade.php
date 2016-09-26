@extends('layouts.app')

@section('htmlheader_title')
	home
@endsection

@section('contentheader_title')
  {{ trans('adminlte_lang::message.app_name') }}
@endsection

@section('contentheader_description')
  Control panel
@endsection


@section('main-content')
	<div class="row">
	    <div class="col-lg-12 col-xs-6">
	        <div class="box box-default">
	            <div class="box-header with-border">
	              <h3 class="box-title"></h3>
	              <div class="pull-left box-tools">
	                  <!--<a href="" data-remote="true" class="btn btn-success btn-sm" role="button" data-toggle="tooltip" title="Adicionar">
	                       <i class="fa fa-plus"></i>
	                  </a>-->
	                  
	              </div><!-- /. tools -->
	            </div><!-- /.box-header -->
	  
	            <div class="box-body">
	            </div>
	        </div>
	    </div>
	</div>
@endsection
