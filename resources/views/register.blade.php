@extends('layout', ['page' => 'register', 'data' => []])

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card card-body">
                    {!!
                        Form::open([
                            'route' => ['auth.register'],
                            'method' => 'POST',
                            'class' => 'form',
                            'autocomplete' => 'off'
                        ])
                    !!}
                        <div class="form-group">
                            <label for="name">Name</label>
                            {!! Form::text('name', old('name', ''), [ 'class' => 'form-control '. ($errors->has('name') ? 'is-invalid' : '') ]) !!}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
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
                        <div class="form-group">
                            <label for="confirm-password">Confirm password</label>
                            {!! Form::password('password_confirmation', [ 'class' => 'form-control '. ($errors->has('password_confirmation') ? 'is-invalid' : '') ]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a class="btn btn-default" href="{{ route('login') }}">Back</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection