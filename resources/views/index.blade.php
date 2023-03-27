@extends('marketing::layouts.app')

@section('title', __('News'))

@section('heading')
    {{ __('News') }}
@endsection

@section('content')

    <!-- Nav !-->
    @include('news::partials.nav')
    <div id="accordion">
        @if(@$trending)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2>
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                           aria-controls="collapseOne">
                            Trending Terms
                        </a>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-table table-responsive">
                        <ul>
                            @foreach($trending as $keyword)
                                <li>
                                    <h6>
                                        <a href="{{ route('news.topic', ['topic' => $keyword]) }}">
                                            {{ $keyword }}
                                        </a>
                                    </h6>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


        <!-- News API !-->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h3>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseSecond" aria-expanded="true"
                       aria-controls="collapseSecond">
                        NewsApi.org - {{ Str::camel($topic) }} news
                    </a>
                </h3>
            </div>
            <div id="collapseSecond" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-table table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news_api as $item)

                            <tr>
                                <td>
                                    <a href="{{ $item->url }}" target="_blank">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        {{ $item->author }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->publishedAt }}
                                </td>
                                <td>
                                    <a href="{{ route('news.show', ['url' => base64_encode($item->url)]) }}">
                                        {{ __('Extract') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Google News API !-->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h3>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseThird" aria-expanded="true"
                       aria-controls="collapseThird">
                        Google News - {{ ($topic) }} news
                    </a>
                </h3>
            </div>
            <div id="collapseThird" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-table table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($google_news as $item)
                            <tr>
                                <td>
                                    <a href="{{ $item["link"] }}" target="_blank">
                                        {{ $item["title"] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        {{ $item["media"] }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item["date"] }}
                                </td>
                                <td>
                                    <a href="{{ route('news.show', ['url' => base64_encode($item["link"])]) }}">
                                        {{ __('Extract') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
