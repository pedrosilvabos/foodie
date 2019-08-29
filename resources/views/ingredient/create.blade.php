@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        {!! Form::open(['route' => 'ingredients.store']) !!}
        <div class="form-group">
            {!! Form::label('ingredient_name', 'Ingredient Name') !!}
            {!! Form::text('ingredient_name', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ingredient_type', 'Ingredient Type') !!}
            {!! Form::text('ingredient_type', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ingredient_quantity_kg', 'Ingredient Quantity') !!}
            {!! Form::number('ingredient_quantity_kg', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ingredient_proteins', 'Ingredient Protein Value(per Ingredient)') !!}
            {!! Form::number('ingredient_proteins', null, ['class' => 'form-control','required' => 'required','step' => '0.1']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ingredient_price', 'Ingredient Price') !!}
            {!! Form::number('ingredient_price', null, ['class' => 'form-control','required' => 'required','step' => '0.1']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ingredient_servings', 'Ingredient servings') !!}
            {!! Form::number('ingredient_servings', null, ['class' => 'form-control','required' => 'required','step' => '0.1']) !!}
        </div>


        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

        {!! Form::close() !!}
    </div>

@endsection


