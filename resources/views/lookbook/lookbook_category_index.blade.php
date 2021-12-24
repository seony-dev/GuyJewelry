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
            <ul class="works-grid works-hover-w" id="works-grid">
                @if ( count($lookbook_sub_category_list) > 0 )
                    @foreach($lookbook_sub_category_list as $lookbook_sub_category)
                        <li class="work-item illustration webdesign move_sub_category" data-id="{{$lookbook_sub_category->id}}">
                            <div class="work-image">
                                <img src="{{$lookbook_sub_category->lookbook_sub_category_image}}" alt="{{$lookbook_sub_category->lookbook_sub_category_name}}"/>
                            </div>
                            <div class="work-caption font-alt">
                                <h3 class="work-title">{{$lookbook_sub_category->lookbook_sub_category_name}}</h3>
                                <div class="work-descr"></div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        {{--        @if ( session('admin_session') )--}}
        {{--            <div align="right">--}}
        {{--                <button class="btn btn-d btn-round" id="notice_write">글쓰기</button>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </section>

    <script>
        $(document).ready(function(){


            $(".move_sub_category").on("click", function(){
                var lookbook_main_category_id = $(this).attr("data-id");

                var lookbookFrm = document.createElement('form');

                var objs;

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', 'lookbook_main_category_id');
                objs.setAttribute('value', lookbook_main_category_id);
                lookbookFrm.appendChild(objs);

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', '_token');
                objs.setAttribute('value', '{{ csrf_token() }}');
                lookbookFrm.appendChild(objs);

                lookbookFrm.setAttribute('method', 'get');
                lookbookFrm.setAttribute('action', "/lookbook/category");

                document.body.appendChild(lookbookFrm);
                lookbookFrm.submit();

            });
        });

    </script>
@endsection
