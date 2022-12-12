<div class="page_alumni">
    <div class="container">
        <div class="content_alumni">
            <h2 class="title_page">{{__($section->title)}}</h2>
            <div class="list_alumni">
                <div class="multiple-items">
                    @foreach ($section->page_contents as $content )
                    <div class="item_alumni">
                        <div class="content_item_alumni">
                            <img src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid" alt="">
                            <div class="blog_alumni">
                                <span>{{__($section->title)}}</span>
                            </div>
                        </div>
                        <div class="content_text_alumni">
                            <a href="" class="link_alumni">
                                <h6>{{__($content->title)}}</h6>
                                <span class="clamp three-lines text_page">  {!!Str::words(strip_tags(__($content->description)), 60, '...')!!} </span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                
                    
                </div>
            </div>
        </div>
    </div>
</div>
