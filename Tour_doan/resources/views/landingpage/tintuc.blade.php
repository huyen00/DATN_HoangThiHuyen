@extends('landingpage.layout')
@section('content')
<div id="body">
    <div class="container">
        <div class="page_new">
            <div class="row">
                <div class="menu_page_left">
                    <h6 class="title_menu_page">Tin tức - Sự kiện</h6>
                    <h6 class="title_item_left"> Tin tức</h6>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                           Thông báo
                        </a>
                    </li>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Tin bài
                        </a>
                    </li>
                    <h6 class="title_item_left">Sự kiện</h6>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Sự kiện sắp diễn ra
                        </a>
                    </li>
                    <li class="item_menu_left">
                        <a href="" class="link_menu_left">
                            Sự kiện đã diện ra
                        </a>
                    </li>
                    
                </div>
                <div class="content_page_right">
                    <div class="content_introduce">
                        <div class="image_banner_introduce">
                            <img src="../assets/image/banner1.jpg" class="img_page" alt="">
                        </div>
                        <div class="list_content_right">
                            <div class="row">
                                <div class="list_new_left">
                                    <div class="row">
                                        @foreach ($news as $new )
                                        <div class="item_new_left">
                                            <div class="image_new">
                                                <img src="{{$new->image}}" class="img_page" alt="">
                                            </div>
                                            <a href="{{route('new.detail',__($new->slug))}}">
                                                <h6 class="title_new">{{__($new->title)}}
                                            </a>
                                            <div class="date_new">
                                                <span>{{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y')}}</span>
                                            </div>
                                            <div class="text_new">
                                                <span class="clamp three-lines text_page">{!!Str::words(strip_tags(__($new->content)), 10, '...')!!}</span>
                                            </div>
                                        </div>

                                        @endforeach
                                      
                                    </div> 
                                </div>
                                <div class="list_new_right">
                                    <h6 class="title_noibat">Tin Nổi Bật</h6>
                                    <div class="content_new_right">
                                        @foreach ($outstanding_news as $new )
                                        <div class="item_new_right">
                                            <div class="row">
                                                <div class="image_new_right">
                                                    <img src="{{$new->image}}" class="img_page" alt="">
                                                </div>
                                                <div class="text_new_right">
                                                    <span class="date_new_noibat">-> {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y')}}</span>
                                                    <a href="{{route('new.detail',__($new->slug))}}" class="">{!!Str::words(strip_tags(__($new->content)), 10, '...')!!}</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                              
                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection