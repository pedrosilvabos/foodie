@extends('layouts.app')

@section('content')
<showallrecipes  :user="{{ $user }}"> </showallrecipes>
@endsection
