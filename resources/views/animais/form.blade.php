<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_gaiola', 'Gaiola:') !!}
			{!! Form::select('id_gaiola',['' => 'Escolha o Gaiola'] + $gaiolas,$animal->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('tatuagem', 'Tatuagem:') !!}
			{!! Form::text('tatuagem', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_raca', 'Raça:') !!}
			{!! Form::select('id_raca',['' => 'Escolha o Raca'] + $racas,$animal->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('ciclo', 'Ciclo:') !!}
			{!! Form::text('ciclo', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_fornecedor', 'Fornecedor:') !!}
			{!! Form::select('id_fornecedor',['' => 'Escolha o Fornecedor'] + $fornecedores,$animal->id_fornecedor, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_nascimento', 'Data Nascimento:') !!}
			{!! Form::date('data_nascimento', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('peso_entrada', 'Peso Entrada:') !!}
			{!! Form::text('peso_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('tipo_uso', 'Tipo Uso:') !!}
			{!! Form::text('tipo_uso', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('sexo', 'Sexo:') !!}
			{!! Form::text('sexo', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_entrada', 'Data Entrada:') !!}
			{!! Form::date('data_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('ciclo_entrada', 'Ciclo Entrada:') !!}
			{!! Form::text('ciclo_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>