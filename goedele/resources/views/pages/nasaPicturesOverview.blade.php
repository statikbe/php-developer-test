@extends('layouts.default')
@section('content')
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>    
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    @push('scripts')
        <script type="text/javascript" src="{{URL::asset('/coolTheme/js/main.js')}}"></script>
    @endpush

    <div class="title my-5 text-center"><h1>{{$title}}</h1></div>
    <div class="row"  >
        <form class="row g-3 align-items-center justify-center mb-5">
            <div class="col-auto row g-3 align-items-center">
                <div class="col-auto">
                    <label for="sortOrder" class="col-form-label">Sort by</label>
                </div>
                <div class="col-auto">
                    <select id="sorted" name="sorted" class="form-select" aria-label="Sort by">
                        @php
                            $sortOptions = ['date'=>'Date', 'likes'=>'Likes', 'title'=>'Title'];
                        @endphp
                        @if(request()->query('sorted'))
                            @if (array_key_exists(request()->query('sorted'), $sortOptions ))
                                <option selected value="{{request()->query('sorted')}}">{{$sortOptions[request()->query('sorted')]}}</option>
                            @endif
                        @endif
                        <option value="date">Date</option>
                        <option value="likes">Likes</option>
                        <option value="title">Title</option>
                    </select>
                </div>
            </div>
            <div class="col-auto row g-3 align-items-center">
                <div class="col-auto">
                    <label for="amount" class="col-form-label">Number of pictures shown</label>
                </div>
                <div class="col-auto">
                    @php
                        $amount=30;
                    @endphp
                    @if(request()->query('amount'))
                        @if (strval(request()->query('amount')) === strval(intval(request()->query('amount')) ))
                            @php
                                $amount=request()->query('amount');
                            @endphp
                        @endif
                    @endif
                    <input type="number" class="form-control" id="amount" name="amount" min="1" max="50" value="{{$amount}}">
                </div>
            </div>

            <div class="col-auto row g-3 align-items-center col-auto">
                <button href="{{ request()->fullUrl() }}?sorted=sorted&amount=amount" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="row masonry-set" >
        @foreach($pictures as $picture)
        <div class="masonry-card col-sm-6 col-lg-4 mb-4">
            <div class="card h-100">
                @isset($picture['url'])
                    <img src="{{$picture['url']}}" class="card-img-top" alt="{{$picture['title']}}">
                @endisset
                <div class="card-body">

                    @isset($picture['title'])
                        <h5 class="card-title">{{$picture['title']}}</h5>
                    @endisset
                    @isset($picture['date'])
                        <h6 class="card-subtitle mb-2 text-muted">{{$picture['date']}}</h6>
                    @endisset
                    <div class="text-center mt-3">
                        <a href="{{route('singlePicture', $picture['date'])}}" class="btn btn-outline-dark btn-sm card-link text-center">Show me more</a>
                        @isset($picture['likes'])
                        @if (session('hasLiked'))
                            @if (in_array($picture['id'], session('hasLiked')) )
                                @php
                                    $picture['likes'] = "<b>" . $picture['likes'] ."</b>";
                                @endphp
                            @endif
                        @endif
                            @php
                                echo Form::button(
                                    "&#10084; <span id='likes" . $picture["id"]. "'>" . $picture['likes'] . "</span>",
                                    [
                                        'class' => 'btn btn-sm btn-outline-primary float-left',
                                        'onClick'=>'addLike(' . $picture['id'] . ')'
                                    ]
                                );
                            @endphp
                        @endisset                    
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@stop
