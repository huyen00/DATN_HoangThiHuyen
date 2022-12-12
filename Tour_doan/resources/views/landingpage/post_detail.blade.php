@extends('landingpage.layout')
@section('content')
<div id="body">
    <div class="container">
        <div class="page_item_news">
            <div class="row">
                <div class="content_item_news">
                    <h2>{{__($content->title)}}</h2>
                    <img src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid" alt="">
                    <span>{!!__($content->description)!!}</span>
                </div>
                <div class="categori_item_news">
                
                   
                    <div class="featured_news_list">
                        <h5>Featured News</h5>
                        <ul class="related_news" style="top: 100px;">
                            @foreach($content_lienquan as $content )
                            <li class="col_related_news">
                                <div class="row ">
                                    <div class="news_is">
                                        <a href="">
                                            <img src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid img_featured" alt="">
                                        </a>
                                    </div>
                                    <div class="text_news">
                                        <h5 class="title_featured_item_news"></a><a href="{{route('new.detail',__($content->sub_title))}}">{{__($content->title)}}</a></h5>
                                        <div class="der_news clamp three-lines text_page">
                                            {!!Str::words(strip_tags(__($content->description)), 5, '...')!!}</div>

                                        <div class="box_duoi">
                                            <div class="left_news">
                                                <i class="fa-regular fa-calendar-days"></i>  {{ \Carbon\Carbon::parse($content->created_at)->format('d/m/Y')}}</div>
                                            <a href="{{route('post.detail',__($content->sub_title))}}" class="read_view">See more <i class="fa-regular fa-calendar-days"></i></a>
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