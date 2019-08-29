@foreach($ingredients as $ingredient)
<li>{{ $ingredient->ingredient_name }}</li>
@endforeach

@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        {!! Form::open(['route' => 'recipe.store']) !!}
        <div class="form-group">
            {!! Form::label('recipe_name', 'Recipe Name') !!}
            {!! Form::text('recipe_name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('recipe_type', 'Recipe Type') !!}
            {!! Form::text('recipe_type', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('recipe_cost', 'Recipe Cost') !!}
            {!! Form::text('recipe_cost', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('recipe_discription', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('recipe_protein', 'Recipe Protein') !!}
            {!! Form::text('recipe_protein', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

        {!! Form::close() !!}
    </div>

@endsection


