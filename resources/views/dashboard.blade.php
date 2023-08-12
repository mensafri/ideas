@extends('layout.app')
@section('content')
    @include('shared.navbar')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.sidebar')
            </div>
            <div class="col-6">
                @include('shared.success')
                @include('shared.error')
                @include('shared.submit')
                <hr>
                @foreach ($ideas as $idea)
                    <div class="mt-3">
                        @include('shared.idea-card')
                    </div>
                @endforeach
                <div class="mt-3">
                    {{ $ideas->links() }}
                </div>
            </div>
            <div class="col-3">
                @include('shared.search')
                @include('shared.follow')
            </div>
        </div>
    </div>
@endsection
