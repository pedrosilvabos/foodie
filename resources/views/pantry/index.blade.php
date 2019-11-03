@extends('layouts.app')

@section('content')
All the pantries
<ul>
   
        <pantrylist :user="{{ $user }}" > </pantrylist>
</ul>
@endsection

