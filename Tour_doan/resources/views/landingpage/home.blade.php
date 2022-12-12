@extends('landingpage.layout')
@section('content')
    @foreach ($page->sections as $key => $section)
           @include($section->theme->link_code)         
    @endforeach
@endsection