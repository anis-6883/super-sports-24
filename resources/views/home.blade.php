<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ get_option('site_title') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ get_option('site_title') }}" name="keywords">
    <meta content="{{ get_option('site_title') }}" name="description">
    <meta content="imANTHOONY" name="developmentby">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ get_icon() }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('public/website') }}/lib/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('public/website') }}/lib/slick/slick-theme.css" rel="stylesheet">
    <link href="https://unpkg.com/video.js@5.16.0/dist/video-js.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" rel="stylesheet">
    <link href="{{ asset('public/website') }}/css/style.css" rel="stylesheet">
    <style type="text/css">
        .video-js {
            width: 100%;}

            /* Next Match */
            .ec-nextmatch {
                border: 1px solid #f3f3f3;
                border-top: none;
                background-color: #fff;
                margin-bottom: 60px;
            }
            .ec-team-matches{
                border-radius: 10px;
                border: 1px solid #FF6F61;
            }

            .ec-team-matches:focus {
              border-radius: 10px;
          }

          .live {
            border: 1px solid #000 !important;
            border-radius: 10px;
        }
        .ec-nextmatch,.ec-team-matches,.ec-match-countdown,
        .ec-match-countdown .countdown-row,.ec-ticket-button {
            float: left;
            width: 100%;
        }
        .ec-nextmatch.owl-carousel .owl-item img {
            width: auto;
            display: inline-block;
            margin-bottom: 3px;
        }
        .ec-team-matches li {
            float: left;
            width: 33.333%;
            list-style: none;
            text-align: center;
            padding: 25px 0px;
        }

        .ec-team-matches li img{
            width: 60px;
            height: 60px;
            border-radius: 10px;
        }
        .ec-team-matches li a span {
            display: block;
        }
        .ec-team-matches li small {
            font-size: 14px;
            color: #555555;
            text-transform: uppercase;
        }
        .ec-team-matches li time {
            display: block;
            font-size: 24px;
            font-weight: bold;
        }
        .ec-match-countdown .countdown-section {
            color: #999999;
            float: left;
            width: 25%;
            background-color: #f6f6f6;
            font-size: 15px;
            text-transform: uppercase;
            border-left: 1px solid #eeeeee;
            text-align: center;
            padding: 9px 0px;
        }
        .ec-match-countdown .countdown-section:first-child { border-left: none; }
        .ec-match-countdown .countdown-amount {
            color: #333333;
            font-weight: bold;
            margin-right: 2px;
        }
        .ec-ticket-button {
            text-align: center;
            font-size: 15px;
            color: #555555;
            padding: 20px 0px;
        }
        .ec-nextmatch .owl-prev {
            left: auto;
            right: 43px;
            margin: 0px;
            top: -34px;
            width: 21px;
            height: 21px;
            background-color: #f7f7f7;
            color: #555555;
            font-size: 15px;
            font-weight: bolder;
            line-height: 1.2;
        }
        .ec-nextmatch .owl-next {
            right: 16px;
            top: -34px;
            margin: 0px;
            width: 21px;
            height: 21px;
            background-color: #f7f7f7;
            color: #555555;
            font-size: 15px;
            font-weight: bolder;
            line-height: 1.2;
        }
        .ec-nextmatch .owl-prev:hover,.ec-nextmatch .owl-next:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                @if ($top_ads)
                <a target="_blank" style="margin: auto;" rel="nofollow noopener" href="{{ $top_ads->action_url }}">
                    <div class="top-ads"><img style="    width: 80%;height: 80px;" src="{{ asset($top_ads->image) }}" alt=""></div>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container-fluid pb-4">
            <div class="row">
                <div class="col-md-2 left-side-ads">
                    @if ($left_ads)
                    <a target="_blank"  href="{{ $left_ads->action_url }}">
                        <img alt="" class="i-amphtml-fill-content i-amphtml-replaced-content w-100" decoding="async" src="{{ asset($left_ads->image) }}">
                    </a>
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="video">
                     <video id="live-stream" class="video-js vjs-default-skin" height="400" preload="auto" controls preload="auto" width="100%" height="268" data-setup='{}' autoplay="true">
                     </video>
                 </div>
                 <div class="featured-product product">
                    <div class="container-fluids">
                        <div class="row align-items-center product-slider live-matches">
                            @foreach ($live_matches as $match)
                            <ul class="ec-team-matches bg-white mx-3 pl-0 {{ $live_match != null ? $match->id == $live_match->id ? 'live' : '' : ''}}">
                                <a href="{{ getGeneratedToken($live_match->stream_url, $live_match->stream_key, request()->ip()) }}" class="play">
                                    <li class="text-center">
                                        <img class="m-auto" src="{{ $match->team_one_image  != '' ?$match->team_one_image : asset('public/default/stream.jpg') }}" alt=""> 
                                        <b><span style="font-size: 12px;" class="b">{{ $match->team_one_name }}</span></b>
                                    </li>
                                    <li>
                                        <b>VS</b><br>
                                        <small>{{ $match->match_title }}</small>
                                    </li>
                                    <li class="text-center">
                                        <img class="m-auto" src="{{ $match->team_two_image  != '' ?$match->team_two_image : asset('public/default/stream.jpg') }}" alt=""> 
                                        <b><span style="font-size: 12px;" class="b">{{ $match->team_two_name }}</span></b>
                                    </li>
                                </a>
                            </ul>
                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 bg-white" style="    height: fit-content;">
                <div class="text-center pt-2">
                    <h4>Match Prediction</h4>
                </div>
                <hr>
                <nav class="navbar bg-light" style="overflow: hidden;">
                    <ul class="navbar-nav" data-autoscroll style="height: 500px; overflow: hidden;">
                        @foreach ($predictions as $prediction)
                        <li class="nav-item py-4">
                            <b>{{ $prediction->team_one_name }}</b> VS <b>{{ $prediction->team_two_name }}</b> (<b>{{ $prediction->match_title }}</b>): {{ $prediction->prediction }}
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>&copy; <a href="https://cric2day.com">2021 Cric2Day</a>. All Rights Reserved</p>
            </div>

        </div>
    </div>
</div>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/website') }}/lib/easing/easing.min.js"></script>
<script src="{{ asset('public/website') }}/lib/slick/slick.min.js"></script>
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script src="{{ asset('public/website') }}/js/main.js"></script>
<script>
    const player = videojs('live-stream');
    player.src({
        src: '{{ $live_match != null ? getGeneratedToken($live_match->stream_url, $live_match->stream_key, request()->ip()) : '' }}',
        type: 'application/x-mpegURL'
    });

    $('.play').on('click',  function(event) {
        event.preventDefault();

        $('.ec-team-matches').removeClass('live');
        $(this).closest('.ec-team-matches').addClass('live');

        player.src({
            src: $(this).attr('href'),
            type: 'application/x-mpegURL'
        });
    });
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

  (function($) {
    $.fn.autoscroll = function(options) {
        var settings = $.extend({}, $.fn.autoscroll.defaults, options);
        return this.each(function() {
            var $this = $(this);
            if ($this.length > 0 &&
                $this[0].scrollHeight > $this[0].clientHeight) {
                var scrollTimer,
            scrollTop = 0;

            function scrollList() {
                    var itemHeight = $this.children().eq(1).outerHeight(true); // 取第二个高度防止第一个没有上间距
                    scrollTop++;
                    if (scrollTop >= itemHeight) {
                        $this.scrollTop(0).children().eq(0).appendTo($this);
                        scrollTop = 0;
                    } else {
                        $this.scrollTop(scrollTop);
                    }
                }
                // 鼠标悬停时停止播放
                $this.hover(function() {
                    clearInterval(scrollTimer);
                    $this.css("overflow-y", "hidden");
                    // if (settings.hideScrollbar) {
                    //     $this.addClass("hide-scrollbar");
                    // }
                    if($.type(settings.handlerIn) === "function") {
                        settings.handlerIn();
                    }
                }, function() {
                    $this.css("overflow-y", "hidden");
                    scrollTimer = setInterval(function() {
                        scrollList();
                    }, settings.interval);
                    if($.type(settings.handlerOut) === "function") {
                        settings.handlerOut();
                    }
                }).trigger("mouseleave");
            }
        });
    }
    $.fn.autoscroll.defaults = {
        interval: 50, // 控制速度
        hideScrollbar: true, // 隐藏滚动条但可以滚动
        handlerIn: null, // 鼠标悬停
        handlerOut: null // 鼠标离开

    };
    $(function() {
        $("[data-autoscroll]").autoscroll();
    });
})(jQuery);
</script>
</body>
</html>
