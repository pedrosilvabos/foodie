@extends('layouts.app')

@section('content')
All the Ingredients
<ul>
        <IngredientList :user="{{ $user }}"> </IngredientList>
</ul>
@endsection

