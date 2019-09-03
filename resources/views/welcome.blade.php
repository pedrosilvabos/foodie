<!DOCTYPE html>
@extends('layouts.app')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
        @section('content')
            <div class="content">
            <div class="container">
                    <div class="row">
                        <div class="col">
                                <a href="/ingredients">
                                <img src="{{ URL::to('images/mainpage/ingredients.jpg') }}">
                                </a>
                        </div>
                        <div class="col">
                            <a href="/pantry">
                                <img src="{{ URL::to('images/mainpage/pantry.jpg') }}">
                            </a>
                        </div>
                        <div class="col">
                                <a href="/recipe">
                                <img src="{{ URL::to('images/mainpage/recipeBook.jpg') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
    <script src="js/app.js" charset="utf-8"></script>
</html>
