@extends('landingpage.layout')
@section('content')
    @foreach ($page->sections as $key => $section)
       @if($key ==1)
            @include('landingpage.theme.new')
        @endif
         
           @include($section->theme->link_code)         
    @endforeach
@endsection