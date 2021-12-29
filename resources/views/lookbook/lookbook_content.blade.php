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
            <div class="row multi-columns-row">
                @if ( count($lookbook_list) > 0 )
                    @foreach($lookbook_list as $lookbook)
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="gallery-item">
                                <div class="gallery-image">
                                    <a class="gallery" href="{{$lookbook->lookbook_image}}" title="{{$lookbook->lookbook_title}}">
                                        <img src="{{$lookbook->lookbook_image}}" alt="{{$lookbook->lookbook_title}}"/>
                                        <div class="gallery-caption">
                                            <div class="gallery-icon"><span class="icon-magnifying-glass"></span></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
{{--            <div align="center" style="margin-top: 10px;">--}}
{{--                {{$lookbook_list->links()}}--}}
{{--            </div>--}}
        </div>
    </section>

    <script>
        $(document).ready(function(){

            $(".move_content").on("click", function(){
                var lookbook_sub_category_id = $(this).attr("data-id");

                var lookbookFrm = document.createElement('form');

                var objs;

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', 'lookbook_sub_category_id');
                objs.setAttribute('value', lookbook_sub_category_id);
                lookbookFrm.appendChild(objs);

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', '_token');
                objs.setAttribute('value', '{{ csrf_token() }}');
                lookbookFrm.appendChild(objs);

                lookbookFrm.setAttribute('method', 'post');
                lookbookFrm.setAttribute('action', "/lookbook/content");

                document.body.appendChild(lookbookFrm);
                lookbookFrm.submit();

            });
        });

    </script>
@endsection
