@extends('layouts.app')

@section('content')
    <produtos-component :produtos-list='@json($produtos)' :cidade='@json($cidade)'></produtos-component>
@endsection
