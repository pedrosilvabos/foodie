@extends('layouts.app')

@section('content')

<ul>
<createingredient> </createingredient>
<IngredientList :user="{{ $user }}"> </IngredientList>
</ul>
@endsection