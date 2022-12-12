<div class="page_news">
    <div class=" container content_news">
        <h2 class="title_page">Tin Mới Nhất</h2>
        <div class="list_news">
            @foreach ($last_new as $new )
            <div class="item_news">
                <div class="image_news">
                    <img src="landingpage/assets/image/tintuc1.jpeg" class="img-fluid" alt="">
                    <div class="blog">
                        <span>Tin tức</span>
                    </div>
                </div>

                <div class="content_item_news">
                    <a href="{{$new->image}}"><h5>{{__($new->title)}}</h5></a>
                    <div class="text_content_item">
                        <span class="clamp three-lines text_page">{!!Str::words(strip_tags(__($new->content)), 10, '...')!!}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
       
    </div>
    <div class="see_more">
        <a href="page/tintuc.html" class="linh_see_more">Xem tin mới nhất</a>
    </div>
</div>
