@extends('marketing::layouts.app')

@section('title', __('News'))

@section('heading')
    {{ __('News') }}
@endsection

@section('content')

    <!-- Nav !-->
    @include('news::partials.nav')

    <div class="card">
        <div class="card-header" id="headingOne">
            <h3>
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                   aria-controls="collapseOne">
                    {{ __('Trending Terms') }}
                </a>
            </h3>
        </div>
    </div>


    <div class="accordion" id="accordionExample">
        <!-- Block !-->
        <!-- Google !-->
        <div class="accordion-item">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ __('Google trends') }}
                    </h2>
                </div>

                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="card-body">
                    <table  class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Term') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($google as $key => $term)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $term }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>


        <!-- Newspapers !-->
        <div class="accordion-item">
            <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{ __('Newspapers trends') }}
                </h2>
            </div>
            <div class="card-body">
                <table  class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Term') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newspapers as $key => $term)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $term }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>


        <!-- Twitter !-->
        <div class="accordion-item">
            <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{ __('Twitter trends') }}
                </h2>
            </div>
            <div class="card-body">
                <table  class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Term') }}</th>
                        <th scope="col">{{ __('Volume') }}</th>
                        <th scope="col">{{ __('Url') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($twitter as $key => $term)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $term["name"] }}</td>
                            <td>{{ $term["tweet_volume"] }}</td>
                            <td>
                                <a href="{{ $term["url"] }}" target="_blank">
                                    {{ $term["url"] }}
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
