@extends('layouts.default')
@section('content')
    <div class="title my-5 text-center"><h1>{{$title}}</h1></div>

    <div class="row">
        <div class="text-center">
            @isset($picture['hdurl'])
                <img src="{{$picture['hdurl']}}" class="img-fluid" alt="{{$picture['title']}}">
            @endisset
            @isset($picture['copyright'])
                <p class="text-end">@copyright {{$picture['copyright']}}</p>
            @endisset
            @isset($picture['likes'])
                @if (session('hasLiked'))
                    @if (in_array($picture['id'], session('hasLiked')) )
                        @php
                            $picture['likes'] = "<b>" . $picture['likes'] ."</b>";
                        @endphp
                    @endif
                @endif
                <div class='text-start'>
                    @php
                        echo Form::button(
                            "&#10084; <span id='likes" . $picture["id"]. "'>" . $picture['likes'] . "</span>",
                            [
                                'class' => 'btn btn-large btn-primary float-left',
                                'onClick'=>'addLike(' . $picture['id'] . ')'
                            ]
                        );
                    @endphp
                </div>
            @endisset

            @isset($picture['title'])
                <h2 class="h2 mt-5">{{$picture['title']}}</h2>
            @endisset
            @isset($picture['explanation'])
                <div class="text-start">
                    <p class="">{{$picture['explanation']}}</p>
                </div>
            @endisset
        </div>
    </div>
@stop
