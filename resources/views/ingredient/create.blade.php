@extends('layouts.app')

@section('content')

<ul>
<createingredient> </createingredient>
<ingredientList :user="{{ $user }}"> </ingredientList>
</ul>
@endsection