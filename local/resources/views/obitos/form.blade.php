<div class="row">

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_animal', 'Animal:') !!}
			{!! Form::select('id_animal', ['' => 'Escolha o animal'] + $animal, $obitos->id_fase, ['class'=>'form-control select2','style'=>'width: 100%;']) !!}
		</div>
	</div>
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_maternidade', 'Maternidade:') !!}
			{!! Form::select('id_maternidade', ['' => 'Escolha o animal'] + $maternidades, $obitos->id_fase, ['class'=>'form-control select2','style'=>'width: 100%;']) !!}
		</div>
	</div>	

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_engorda', 'Engorda:') !!}
			{!! Form::select('id_engorda', ['' => 'Escolha a gaiola'] + $engordas, $obitos->id_fase, ['class'=>'form-control select2','style'=>'width: 100%;']) !!}
		</div>
	</div>	
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('causa', 'Causa *:') !!}
			{!! Form::text('causa', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data', 'Data *:') !!}
			{!! Form::date('data', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('quantidade', 'Quantidade:') !!}
			{!! Form::text('quantidade', 1, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>