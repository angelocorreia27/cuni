<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_gaiola', 'Gaiola:') !!}
			{!! Form::select('id_gaiola',['' => 'Escolha o Gaiola'] + $gaiolas,$reproducao->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_reprodutor', 'Reprodutor:') !!}
			{!! Form::select('id_reprodutor',['' => 'Escolha o Reprodutor'] + $reprodutor,$reproducao->id_reprodutor, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_matriz', 'Matriz:') !!}
			{!! Form::select('id_matriz',['' => 'Escolha a Matriz'] + $matrizes,$reproducao->id_matriz, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_cobertura', 'Data Cobertura:') !!}
			{!! Form::date('data_cobertura', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	 <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('prev_parto', 'Prevenção de Parto:') !!}
			{!! Form::date('prev_parto', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('rep_cio', 'Prevenção de Cio:') !!}
			{!! Form::text('rep_cio', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('aborto', 'Aborto:') !!}
			{!! Form::text('aborto', null, ['class'=>'form-control']) !!}
		</div>
	</div>	
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_parto', 'Data de Parto:') !!}
			{!! Form::date('data_parto', null, ['class'=>'form-control']) !!}
		</div>
	</div>


	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>