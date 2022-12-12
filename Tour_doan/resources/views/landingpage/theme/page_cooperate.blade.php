<div class="page_cooperate">
    <div class="content_cooperate">
        <img src="landingpage/assets/image/banner1.jpg" class="img-fluid img_cooperate" alt="">
        <div class="content_image_cooperate">
            <div class="container">
                <h2 class="title_page text-white">{{__($section->title)}}</h2>
                <div class="text_cooperate text-center">
                    <span class="text_page text-white ">{{__($section->sub_title)}}</span>
                </div>
                <div class="list_cooperate">
                    @foreach ($section->page_contents as $content )
                    <div class="item_cooperate">
                        <div class="row">
                            <div class="image_cooperate">
                                <img src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid img_item_cooperate" alt="">
                            </div>
                            <div class="content_cooperate_item">
                                <h6 class="title_cooperate">{{__($content->title)}}</h6>
                                <div class="text_cooperate">
                                    <span class="text_page">
                                        {!!Str::words(strip_tags(__($content->description)), 70, '...')!!}
                                        <a href="">(xem tiếp)</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                
                </div>
            </div>
            
        </div> 
    </div>
           
</div>