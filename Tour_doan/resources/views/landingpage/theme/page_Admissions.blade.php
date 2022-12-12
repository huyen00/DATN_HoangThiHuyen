<div class="page_Admissions">
    <div class="container">
        <div class="content_admissions">
            <div class="title_admissions">
                <h2 class="title_page">{{__($section->title)}}</h2>
                <div class="text_admissions">
                    <span class="text_page">{{__($section->sub_title)}}</span>
                </div>
            </div>
            <div class="row ">
                @foreach ($section->page_contents as $content )
                    
          
                <div class="col_edu_admissions">
                    <div class="row content_col_edu ">
                        <div class="image_education">
                        
                            <img  src="{{count($content->images) >0 ? $content->images[0]->image : ''}}" class="img-fluid" alt="">
                        </div>
                        <div class="content_education">
                            <h6 class="title_education">{{__($content->title)}}</h6>
                            <div class="text_education">
                                <span class="text_page">
                                    {!!Str::words(strip_tags(__($content->description)), 15, '...')!!}
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
