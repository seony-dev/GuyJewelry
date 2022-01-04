@extends('layouts.header')

@section('content')

    <style>
        .sub_category_toggle {
            cursor: pointer;
        }
        .sub_category {
            padding-left: 30px !important;
            cursor: pointer;
        }
    </style>
    <script>
        $(document).ready(function(){

            $(".sub_category").hide();

           $(".sub_category_toggle").click(function(){

               var shop_main_category_id = $(this).attr("data-id");

               var main_category = $(this);

               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                   , url : "/shop/sub_category_list"
                   , data: {
                       shop_main_category_id : shop_main_category_id
                   }
                   , type:'POST'
                   , success:function(result) {

                       main_category.next(".sub_category").empty();

                       var resultStr = '';

                       for(i=0; i<result.length; i++) {
                           resultStr += '<li><a href="#">' + result[i].shop_sub_category_name + '</a></li>';
                       }
                       main_category.next(".sub_category").append(resultStr);
                       main_category.next(".sub_category").toggle();
                   }
                   , error:function() {
                       alert("에러가 발생했습니다. 다시 시도해 주세요");
                   }
               });


           });
        });
    </script>
    <section class="module bg-dark-60 blog-page-header" data-background="/images/shop/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Shop</h2>
                    <div class="module-subtitle font-serif">가이주얼리 상품</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 sidebar">
                    <div class="widget">
                        <form role="form">
                            <div class="search-box">
                                <input class="form-control" type="text" placeholder="Search..."/>
                                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title font-alt">상품 카테고리</h5>
                        <ul class="icon-list">
{{--                            <li><a href="#">Photography - 7</a></li>--}}
{{--                            <li><a href="#">Web Design - 3</a></li>--}}
{{--                            <li><a href="#">Illustration - 12</a></li>--}}
{{--                            <li><a href="#">Marketing - 1</a></li>--}}
{{--                            <li><a href="#">Wordpress - 16</a></li>--}}
                            @if(!empty($shop_main_category_list))
                                @foreach($shop_main_category_list as $shop_main_category)
                                    <li>
                                        <a class="sub_category_toggle" data-id="{{$shop_main_category->id}}">{{$shop_main_category->shop_main_category_name}}</a>
                                        <ul class="sub_category">
{{--                                            <li><a href="index_mp_fullscreen_video_background.html">Ring</a></li>--}}
{{--                                            <li><a href="index_op_fullscreen_gradient_overlay.html">bracelet</a></li>--}}
{{--                                            <li><a href="index_agency.html">Necklace</a></li>--}}
{{--                                            <li><a href="index_portfolio.html">watch</a></li>--}}
{{--                                            <li><a href="index_restaurant.html">etc.</a></li>--}}
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title font-alt">인기 상품</h5>
                        <ul class="widget-posts">
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="/images//rp-1.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                                    <div class="widget-posts-meta">23 january</div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                                    <div class="widget-posts-meta">15 February</div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="/images/rp-3.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Eco bag Mockup</a></div>
                                    <div class="widget-posts-meta">21 February</div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="/images/rp-4.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Bottle Mockup</a></div>
                                    <div class="widget-posts-meta">2 March</div>
                                </div>
                            </li>
                        </ul>
                    </div>
{{--                    <div class="widget">--}}
{{--                        <h5 class="widget-title font-alt">Tag</h5>--}}
{{--                        <div class="tags font-serif"><a href="#" rel="tag">Blog</a><a href="#" rel="tag">Photo</a><a href="#" rel="tag">Video</a><a href="#" rel="tag">Image</a><a href="#" rel="tag">Minimal</a><a href="#" rel="tag">Post</a><a href="#" rel="tag">Theme</a><a href="#" rel="tag">Ideas</a><a href="#" rel="tag">Tags</a><a href="#" rel="tag">Bootstrap</a><a href="#" rel="tag">Popular</a><a href="#" rel="tag">English</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col-sm-8 col-sm-offset-1">
                    <div class="row multi-columns-row">
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/1.jpg" alt="Cold Garb"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera"> 상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Cold Garb</a></h4>£14.00
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/2.jpg" alt="Accessories Pack"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera"> 상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Accessories Pack</a></h4>£9.00
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/3.jpg" alt="Men’s Casual Pack"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera"> 상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Men’s Casual Pack</a></h4>£12.00
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/watchring_main.png" alt="Men’s Garb"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera"> 상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Men’s Garb</a></h4>£6.00
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/watchring_main1.png" alt="Cold Garb"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera">상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Cold Garb</a></h4>£14.00
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="shop-item">
                                <div class="shop-item-image"><img src="/images/shop/watchring_main2.png" alt="Accessories Pack"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-camera">상세보기</span></a></div>
                                </div>
                                <h4 class="shop-item-title font-alt"><a href="#">Accessories Pack</a></h4>£9.00
                            </div>
                        </div>
                    </div>
                    <div class="row" align="center">
                        <div class="col-sm-12">
                            <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="module-small bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title font-alt">About Titan</h5>
                        <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                        <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                        <p>Email:<a href="#">somecompany@example.com</a></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title font-alt">Recent Comments</h5>
                        <ul class="icon-list">
                            <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                            <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                            <li>Andy on <a href="#">Eco bag Mockup</a></li>
                            <li>Jack on <a href="#">Bottle Mockup</a></li>
                            <li>Mark on <a href="#">Our trip to the Alps</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title font-alt">Blog Categories</h5>
                        <ul class="icon-list">
                            <li><a href="#">Photography - 7</a></li>
                            <li><a href="#">Web Design - 3</a></li>
                            <li><a href="#">Illustration - 12</a></li>
                            <li><a href="#">Marketing - 1</a></li>
                            <li><a href="#">Wordpress - 16</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title font-alt">Popular Posts</h5>
                        <ul class="widget-posts">
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                                    <div class="widget-posts-meta">23 january</div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                                <div class="widget-posts-body">
                                    <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                                    <div class="widget-posts-meta">15 February</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
