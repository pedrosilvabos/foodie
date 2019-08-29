@extends('layouts.app')

@section('content')
All the recipes
<ul>
    @foreach($recipes as $recipe)
    <li><a href="{{ route('recipe.show', ['id' => $recipe->id]) }}">{{ $recipe->recipes_name }}</a> </li>
    @endforeach
</ul>
@endsection
