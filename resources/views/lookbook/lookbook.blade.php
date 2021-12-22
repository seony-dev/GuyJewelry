@extends('layouts.header')

@section('content')

    <style>
        table th,td {
            text-align: center;
        }
    </style>
    <section class="module bg-dark-60 about-page-header" style="background-image:url('/images/shop/watchring_main2.png');">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Lookbook</h2>
                    <div class="module-subtitle font-serif">룩북</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <ul class="filter font-alt" id="filters">--}}
{{--                            <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>--}}
{{--                            <li><a class="wow fadeInUp" href="#" data-filter=".illustration" data-wow-delay="0.2s">Illustration</a></li>--}}
{{--                            <li><a class="wow fadeInUp" href="#" data-filter=".marketing" data-wow-delay="0.4s">Marketing</a></li>--}}
{{--                            <li><a class="wow fadeInUp" href="#" data-filter=".photography" data-wow-delay="0.6s">Photography</a></li>--}}
{{--                            <li><a class="wow fadeInUp" href="#" data-filter=".webdesign" data-wow-delay="0.6s">Web Design</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @if ( count($lookbook_main_category_list) > 0 )
                @foreach($lookbook_main_category_list as $lookbook_main_category)
                    <ul class="works-grid works-hover-w" id="works-grid">
                        <li class="work-item illustration webdesign">
                            <a href="#">
                                <div class="work-image">
                                    <img src="{{$lookbook_main_category->lookbook_main_category_image}}" alt="{{$lookbook_main_category->lookbook_main_category_name}}"/>
                                </div>
                                <div class="work-caption font-alt">
                                    <h3 class="work-title">1231312 Identity</h3>
                                    <div class="work-descr">3</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                @endforeach
            @else
            @endif
        </div>
        @if ( session('admin_session') )
            <div align="right">
                <button class="btn btn-d btn-round" id="notice_write">글쓰기</button>
            </div>
        @endif
    </section>

    <script>
        $(document).ready(function(){

        });

    </script>
@endsection
