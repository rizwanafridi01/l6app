@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <p>Token: {{ request()->user()->token ?? 'N/A' }}</p>
                        <form action="{{ route('home') }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-outline-primary" value="Generate Token">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
