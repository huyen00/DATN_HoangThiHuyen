@extends('landingpage.layout')
@section('content')
<div id="body">
    <div class="container">
        <div class="page_item_news">
            <div class="row">
                <div class="content_item_news">
                    <h2>{{__($tintuc->title)}}</h2>
                    <img src="{{$tintuc->image}}" class="img-fluid" alt="">
                    <span>{!!__($tintuc->content)!!}</span>
                </div>
                <div class="categori_item_news">
                
                   
                    <div class="featured_news_list">
                        <h5>Featured News</h5>
                        <ul class="related_news" style="top: 100px;">
                            @foreach($tintuc_lienquan as $tintuc )
                            <li class="col_related_news">
                                <div class="row ">
                                    <div class="news_is">
                                        <a href="">
                                            <img src="{{$tintuc->image}}" class="img-fluid img_featured" alt="">
                                        </a>
                                    </div>
                                    <div class="text_news">
                                        <h5 class="title_featured_item_news"></a><a href="{{route('new.detail',__($tintuc->slug))}}">{{__($tintuc->title)}}</a></h5>
                                        <div class="der_news clamp three-lines text_page">
                                            {!!Str::words(strip_tags(__($tintuc->content)), 5, '...')!!}</div>

                                        <div class="box_duoi">
                                            <div class="left_news">
                                                <i class="fa-regular fa-calendar-days"></i>  {{ \Carbon\Carbon::parse($tintuc->created_at)->format('d/m/Y')}}</div>
                                            <a href="{{route('new.detail',__($tintuc->slug))}}" class="read_view">See more <i class="fa-regular fa-calendar-days"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>  
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
       
    </div>
</div>
@endsection