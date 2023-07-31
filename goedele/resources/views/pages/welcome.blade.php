@extends('layouts.default')
@section('content')

    <div class="jumbotron text-center mt-5">
    <h1 class="display-4">Welcome!</h1>
    <p class="lead">This is Goedele's first ever Laravel app.</p>
    <hr class="my-4">
    <p>Doesn't it look great? Please enjoy yourself by surfing around. Perhaps start by exploring the amazing world of astronomy offered by NASA.</p>
    <p class="lead mt-5">
        <a class="btn btn-nice-color btn-xl" href="{{route('overview30')}}" role="button">Yes please!</br>Give me some astronomy!</a>
    </p>
    </div>

@stop
