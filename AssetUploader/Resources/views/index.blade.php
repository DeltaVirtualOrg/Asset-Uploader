@extends('assetuploader::layouts.frontend')

@section('title', 'DVAssetUploader')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {{ config('assetuploader.name') }}
    </p>
@endsection
