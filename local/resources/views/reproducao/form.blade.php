<div class="row">	

	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_matriz', 'Matriz *:') !!}
			{!! Form::select('id_matriz',['' => 'Escolha a Matriz'] + $matrizes,$reproducao->id_matriz, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_reprodutor', 'Reprodutor *:') !!}
			{!! Form::select('id_reprodutor',['' => 'Escolha o Reprodutor'] + $reprodutor,$reproducao->id_reprodutor, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
		</div>
	</div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_cobertura', 'Data Cobertura *:') !!}
			{!! Form::date('data_cobertura', date('Y-m-d'), ['class'=>'form-control']) !!}
		</div>
	</div>
		
	
	@if (isset($flag)=='Editar')

		<div class="col-lg-3 col-md-4 col-sm-6">
	        <div class="form-group form-group-sm">    
	            <div class="control-label" style="margin-top: 5px;">
	              {!! Form::label('diagnostico', 'Diagnóstico: ')!!}
	            </div>  	
	        	{!! Form::radio('diagnostico', 'P') !!}
	        	{!! Form::label('Positivo', 'Positivo') !!}
	        	{!! Form::radio('diagnostico', 'N') !!}	
				{!! Form::label('Negativo', 'Negativo') !!}			
			</div>
		</div> 

		<div class="col-lg-3 col-md-4 col-sm-6">
	        <div class="form-group form-group-sm">
				{!! Form::label('aborto', 'Aborto:') !!}
			    {{ Form::checkbox('aborto', 'Sim') }}
			</div>
		</div> 
		
		<div class="col-lg-3 col-md-4 col-sm-6">
	        <div class="form-group form-group-sm">
				{!! Form::label('data_parto', 'Data de Parto:') !!}
				{!! Form::date('data_parto', null, ['class'=>'form-control']) !!}
				<!--<input type="date" class="form-control" id="data_parto">-->
			</div>
		</div> 
	@endif

	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>