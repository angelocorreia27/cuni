<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_maternidade', 'Maternidade *:') !!}
			{!! Form::select('id_maternidade',['' => 'Escolha o Maternidade'] + $maternidades,$reposicao->id_maternidade, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_gaiola', 'Gaiola *:') !!}
			{!! Form::select('id_gaiola',['' => 'Escolha o Gaiola'] + $gaiolas,$reposicao->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_entrada', 'Data Entrada *:') !!}
			{!! Form::date('data_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('quantidade', 'Quantidade *:') !!}
			{!! Form::number('quantidade', null, ['class'=>'form-control']) !!}
		</div>
	</div>
    <!--
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('dias_fase', 'Dias de Fase:') !!}
			{!! Form::number('dias_fase', null, ['class'=>'form-control']) !!}
		</div>-->
	</div>
	<!--<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('peso', 'Peso:') !!}
			{!! Form::number('peso', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('prev_saida', 'Previsão Saida:') !!}
			{!! Form::date('prev_saida', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('prev_quantidade', 'Previsão Quantidade:') !!}
			{!! Form::number('prev_quantidade', null, ['class'=>'form-control']) !!}
		</div>
	</div> -->
	</div>
	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>