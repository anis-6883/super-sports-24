<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Super Sports 24</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/backend/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/backend/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url("{{ asset('/public/backend/ss24_image/WallpaperDog-10815854.jpg') }}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-position-y: top;
            padding: 0;
            margin: 0;
            color: white;
            font-family: 'Roboto', sans-serif;


        }

        .WatchLive {
            width: 200px;
            z-index: 9;
            position: relative;
            margin-right: 210px;
        }

        .f400 {
            font-weight: 400;
        }

        .f3 {
            font-weight: 300;
        }

        .fb {
            font-weight: bold;
        }

        .dlogo img {
            width: 140px;
            height: auto;
            margin-top: -40px;
            margin-bottom: -30px;
        }

        .imagr {
            width: 44px;
            height: 44px;
            padding: 5px;
            border-radius: 5px;
        }

        .scrinshortimg {
            width: 100%;
            padding: 15px;
            /* cursor: zoom-in; */

        }

        .slick-dots li button {

            width: 10px;
            height: 10px;
            padding: 1px;
            color: white;
            background-color: white;
            border-radius: 123%;
        }

        .slider div {
            padding: 3px;
        }

        .scrinshortimg {
            border-radius: 10px !important;
            /* border: 1px solid red; */
            padding: 0;
        }

        .mlive {
            /* margin-top: -130px; */
            /* width: 400px; */
        }

        @media screen and (max-width: 768px) {
            .limage {
                text-align: center !important;
            }

            .league {
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;
                width: auto;
            }

            .tcontainer {
                text-align: center;
            }

            .mlive {
                margin-top: -130px;
                width: 300px;
            }

            .WatchLive {
                margin-right: 140px;
            }
        }

        @media screen and (min-width: 768px) {
            body {
                font-size: 17px;
            }

            .mlive {
                margin-top: -160px;
                width: 450px;
            }

            .copyright h6 {
                font-size: 25px;
            }

            .WatchLive {
                margin-right: 250px;
            }
        }
    </style>
</head>

<body style="margin-bottom: -90px; ">
    <div class="bg " style="background-color: rgb(0 0 1 / 50%);">
        <div class="container overflow-hidden">
            <div class="row tcontainer">
                <div class="col-md-6 mt-5">
                    <h2 class="fb">Super Sports 24</h2>
                    <p class="f3">Enjoy Football Matches Live Streaming <br> From All Over The World In This App.
                    </p>
                    <div class="downloadbtn">
                        <a class="dlogo" href="#"><img
                                src="{{ asset('/public/backend/ss24_image/pngwing.com.png') }}" alt=""
                                srcset=""></a>
                        <a class="dlogo" href="#"><img
                                src="{{ asset('/public/backend/ss24_image/pngwing.com (1).png') }}" alt=""
                                srcset=""></a>
                    </div>
                    <h5 class="text-left covtitle f400">We Are Covering</h5>
                    <div class="league" style="">
                        <img class="imagr" style="background-color: white;  margin-right: 5px; "
                            src="{{ asset('/public/backend/ss24_image/League%20Logo/Champions%20League.png') }}"
                            alt="" srcset="">
                        <img class="imagr" style="background-color: #3E003B; margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/premier league.png') }}"
                            alt="" srcset="">
                        <img class="imagr" style="background-color: white;  margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/La Liga.png') }}" alt=""
                            srcset="">
                        <img class="imagr" style="background-color: #D60117; margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/Bundesliga.png') }}" alt=""
                            srcset="">
                        <img class="imagr" style="background-color: #1E353E;  margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/10197.png') }}" alt=""
                            srcset="">
                        <img class="imagr" style="background-color: white;  margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/Seria A.png') }}" alt=""
                            srcset="">
                        <img class="imagr" style="background-color: #7B0202;  margin-right: 5px;"
                            src="{{ asset('/public/backend/ss24_image/League Logo/europa-conference-league.png') }}"
                            alt="" srcset="">

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="limage float-right text-end">
                        <img class="WatchLive" src="{{ asset('/public/backend/ss24_image/Watch+Live.png') }}"
                            alt="Watch+Live" srcset="">
                        <img class="mlive" src="{{ asset('/public/backend/ss24_image/Untitled-1.png') }}"
                            alt="Watch+Live" srcset="">

                    </div>
                </div>

            </div>
            <div class="slider autoplay mt-5 w-100">
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_163545.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_163603.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_163617.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_164054.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_164141.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_164054.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_163545.jpg') }}"
                        alt="" srcset=""> </div>
                <div> <img class="scrinshortimg"
                        src="{{ asset('/public/backend/ss24_image/scrinshort/Screenshot_20221010_163603.jpg') }}"
                        alt="" srcset=""> </div>
            </div>
            <div class="discription mt-5 ">
                <h4 class="f400">About This App <i class="fa-solid fa-arrow-right"></i></h4>
                <p class="f3">Wacth Thousands of Live events and show for the CNF Sports get scores on-demand news,
                    highlights, and
                    expert analysis. <br> Subscribe to the CNF Sports streming service for live sports, exclusive
                    originals,
                    prrmium styivlrd, gsnysdy tools, and more.</p>
            </div>
            <footer class="mb-5 mb-5">
                <h3 class="f400">You Can Enjoy With Us <i class="fa-solid fa-arrow-right"></i></h3>
                <ul class="f3">
                    <li>UEFA Champions League</li>
                    <li>Premier League</li>
                    <li>La Liga</li>
                    <li>FIFA World Cup 2020</li>
                    <li>Bundesilga</li>
                    <li>Ligue 1</li>
                    <li>Serie A</li>
                </ul>
                <div class="copyright text-center py-2">
                    <h6 class="f400"> Enjoy Your Favorite Tournament</h6>
                    <h6 class="f400">In This App</h6>
                </div>
            </footer>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="{{ asset('/public/backend/slick/ezoom.js') }}"></script>
        <script src="{{ asset('/public/backend/slick/slick.js') }}"></script>


    </div>
    <!-- <script src="slick/"></script> -->
    <script>
        $(document).ready(function() {
            $('.autoplay').slick({
                slidesToShow: 6,
                slidesToScroll: 2,
                autoplay: true,
                dots: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    }
                ]
            });
            ezoom.onInit($('.autoplay .scrinshortimg'), {
                hideControlBtn: false,
                onClose: function(result) {
                    console.log(result);
                },
                onRotate: function(result) {
                    console.log(result);
                },
            });

        });
    </script>
</body>

</html>
