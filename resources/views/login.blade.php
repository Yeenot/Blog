@extends('layout', ['page' => 'login', 'data' => []])

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (session()->has('message'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card card-body">
                    {!!
                        Form::open([
                            'route' => ['auth.login'],
                            'method' => 'POST',
                            'class' => 'form',
                            'autocomplete' => 'off'
                        ])
                    !!}
                        <div class="form-group">
                            <label for="email">Email address</label>
                            {!! Form::text('email', old('email', ''), [ 'class' => 'form-control '. ($errors->has('email') ? 'is-invalid' : '') ]) !!}
                            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            {!! Form::password('password', [ 'class' => 'form-control '. ($errors->has('password') ? 'is-invalid' : '') ]) !!}
                            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection