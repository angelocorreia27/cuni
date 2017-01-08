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
			{!! Form::select('id_raca',['' => 'Escolha o Raca'] + $racas,$animal->id_raca, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!}
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
            <div class="control-label" style="margin-top: 5px;">
              {!! Form::label('tipo_uso', 'Tipo Uso: ')!!}
            </div>    	
        	{!! Form::radio('tipo_uso', 'Reproducao', true) !!}
        	{!! Form::label('Reprodução', 'Reprodução') !!}
        	{!! Form::radio('tipo_uso', 'Reposicao') !!}	
			{!! Form::label('Reposição', 'Reposição') !!}			
		</div>
	</div> 

	
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
            <div class="control-label" style="margin-top: 5px;">
              {!! Form::label('sexo', 'Sexo: ')!!}
            </div>
        	{!!Form::radio('sexo', 0, true) !!}		
			{!! Form::label('Femea', 'Femea') !!}
        	{!! Form::radio('sexo', 1) !!}
        	{!! Form::label('Macho', 'Macho') !!}			
		</div>
	</div>

	

	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('data_entrada', 'Data Entrada:') !!}
			{!! Form::date('data_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	{{-- <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('ciclo_entrada', 'Ciclo Entrada:') !!}
			{!! Form::text('ciclo_entrada', null, ['class'=>'form-control']) !!}
		</div>
	</div>
 --}}
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="form-group form-group-sm">
			{!! Form::label('id_banda', 'Banda:') !!}
		    {!! Form::select('id_banda',['' => 'Escolha a Banda'] + $bandas,$animal->id_banda, ['class'=>'form-control select2','style'=>'width: 100%;'])  !!} 	  

			{{-- <select name="id_banda" id="id_banda" class="form-control">
			<option>-- Escolha a Banda --</option>
				@foreach ($bandas as $banda)				
					
					@if ($banda->id == $animal->id_banda)
						<option value="{{$banda->id}}" selected>{{$banda->significado}}</option>	
					@else
						<option value="{{$banda->id}}">{{$banda->significado}}</option>	
					@endif				
				@endforeach
			</select>  --}}
		</div>
	</div> 

	<div class="col-xs-12">      
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary pull-right']) !!}      
    </div>
</div>