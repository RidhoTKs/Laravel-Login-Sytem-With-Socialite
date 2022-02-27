@extends('templates')

@section('content')
    <p>selamat datang {{ Auth::user()->username }}</p>
@endsection
