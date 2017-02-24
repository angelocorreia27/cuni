<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_reproducao', 'Reprodução:') !!}
			{!! Form::text('id_reproducao', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_gaiola', 'Gaiola:') !!}
			{!! Form::select('id_gaiola',['' => 'Escolha o Gaiola'] + $gaiolas,$maternidade->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_parto', 'Data Parto:') !!}
			{!! Form::date('data_parto', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('vivos', 'Vivos:') !!}
			{!! Form::number('vivos', null, ['class'=>'form-control']) !!}
		</div>
	</div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('n_m', 'Numeros de Mortos:') !!}
			{!! Form::number('n_m', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('peso_ninhada', 'Peso Ninhada:') !!}
			{!! Form::number('peso_ninhada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('peso_desmame', 'Peso Desmame:') !!}
			{!! Form::number('peso_desmame', null, ['class'=>'form-control']) !!}
		</div>
	</div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('a_desmamar', 'A Desmamar:') !!}
			{!! Form::number('a_desmamar', null, ['class'=>'form-control']) !!}
		</div>
	</div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('prev_desmame', 'Prevenção Desmame:') !!}
			{!! Form::date('prev_desmame', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('prev_cobertura', 'Prevenção Cobertura:') !!}
			{!! Form::date('prev_cobertura', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>