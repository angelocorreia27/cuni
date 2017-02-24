<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_gaiola', 'Gaiola *:') !!}
			{!! Form::select('id_gaiola',['' => 'Escolha o Gaiola'] + $gaiolas,$reproducao->id_gaiola, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
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
			{!! Form::label('id_matriz', 'Matriz *:') !!}
			{!! Form::select('id_matriz',['' => 'Escolha a Matriz'] + $matrizes,$reproducao->id_matriz, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
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
				{!! Form::label('aborto', 'Aborto:') !!}
			    {!! Form::select('aborto',['' => 'Escolha o valor'] + $abortos,$reproducao->aborto, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!} 	  

				{{-- <select name="aborto" id="aborto" class="form-control">
				<option>-- Escolha o valor --</option>
					@foreach ($abortos as $aborto)				
						
						@if ($aborto->id == $reproducao->aborto)
							<option value="{{$aborto->id}}" selected>{{$aborto->significado}}</option>	
						@else
							<option value="{{$aborto->id}}">{{$aborto->significado}}</option>	
						@endif				
					@endforeach
				</select>  --}}
			</div>
		</div> 
		
		<div class="col-lg-3 col-md-4 col-sm-6">
	        <div class="form-group form-group-sm">
				{!! Form::label('data_parto', 'Data de Parto:') !!}
				{!! Form::date('data_parto', null, ['class'=>'form-control']) !!}
			</div>
		</div> 
	@endif

	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>