<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_reproducao', 'Reprodução *:') !!}
			{!! Form::select('id_reproducao',['' => 'Escolha a cobrição'] + $reproducao ,$maternidade->id_reproducao, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}

		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_parto', 'Data Parto *:') !!}
			{!! Form::date('data_parto', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('n_vivos', 'Nados Vivos *:') !!}
			{!! Form::number('n_vivos', null, ['class'=>'form-control']) !!}
		</div>
	</div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('n_mortos', 'Nados Mortos *:') !!}
			{!! Form::number('n_mortos', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>