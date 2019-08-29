@extends('layouts.app')

@section('content')
All the Ingredients
<ul>
   
    @foreach($ingredients as $ingredient)
    <li><a href="{{ route('ingredients.show', ['id' => $ingredient->id]) }}">{{ $ingredient->ingredient_name }}</a> </li>
    @endforeach
</ul>
@endsection

