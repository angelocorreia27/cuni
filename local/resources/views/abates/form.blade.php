<div class="row">
	

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_engorda', 'Engorda:') !!}
			{!! Form::select('id_engorda',['' => 'Escolha a Engorda'] + $engordas,$abates->id_engorda, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>	

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_animal', 'Animal:') !!}
			{!! Form::select('id_animal',['' => 'Escolha o animal'] + $animais,$abates->id_animal, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_abate', 'Data Abate* :') !!}
			{!! Form::date('data_abate', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<!--
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('peso', 'Peso:') !!}
			{!! Form::text('peso', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	-->

	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>