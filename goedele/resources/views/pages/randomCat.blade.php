@extends('layouts.default')
@section('content')
    <div class="title my-5 text-center"><h1>Here's a random picture of a cat.</h1></div>

    <div class="row">
        <div class="">
            @isset($explanation)
                <p class="">{{$explanation}}</p>
            @else
                <p class="">Here's a random picture of a cat. We hope you enjoy it.</p>
            @endisset
            <img src="https://source.unsplash.com/random/1200x700/?cat" class="img-fluid" alt="a random cat">

        </div>
    </div>
@stop
