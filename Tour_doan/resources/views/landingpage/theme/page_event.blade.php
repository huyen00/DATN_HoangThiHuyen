<div class="page_event">
    <div class="content_event">
        <div class="image_event">
            <img src="landingpage/assets/image/banner2.jpg" class="img-fluid img_item_event" alt="">
            <div class="content_image_event">
                <h2 class="title_page text-white">{{__($section->title)}}</h2>
                <div class="list_event">
                    <div class="container d-flex">
                        @foreach ($section->page_contents as $content )
                        <div class="item_event">
                            <img src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid item_image_event" alt="">
                            <div class="content_item_event">
                                <h5>{{__($content->title)}}</h5>
                                <div class="text_content_item">
                                    <span class="clamp three-lines text_page">{!!Str::words(strip_tags(__($content->description)), 10, '...')!!}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
              
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="see_more mt-0">
            <a href="" class="linh_see_more">Xem sự kiện mới nhất</a>
        </div>
    </div>
</div>