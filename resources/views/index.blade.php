@extends('marketing::layouts.app')

@section('title', __('News'))

@section('heading')
    {{ __('News') }}
@endsection

@section('content')
    <!-- Cards !-->
    <div class="card">
        <div class="card-table table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Date') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $item)
{{--                    @php--}}
{{--                    dd($item);--}}
{{--                    @endphp--}}

                    <tr>
                        <td>
                            <a href="#">
                                {{ $item["title"] }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $item["author"] }}
                            </a>
                        </td>
                        <td>
                            {{ $item["publishedAt"] }}
                        </td>
                    </tr>
                @endforeach
        </div>
    </div>

@endsection
