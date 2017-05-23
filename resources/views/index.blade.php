<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Noisedrops</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
</head>
<body>
    <div class="container" id="app">

        <example></example>

        <div class="row column">
            <a-player :music="{
            title: 'Pick up game',
            author: 'Chung Kang',
            url: 'https://s3-us-west-2.amazonaws.com/noisedrops/basketball.mp3',
            pic: '/images/noisedrops-light.svg',
            lrc: '[00:00.00]lrc here\n[00:01.00]aplayer'
            }"></a-player>
        </div>

        <div class="row column">
            <a-player :music="{
            title: 'Pick up game',
            author: 'Chung Kang',
            url: 'https://s3-us-west-2.amazonaws.com/noisedrops/basketball.mp3',
            pic: '/images/noisedrops-light.svg',
            lrc: '[00:00.00]lrc here\n[00:01.00]aplayer'
            }"></a-player>
        </div>

        <header>
            <div class="row expanded">
                <div class="column small-12 medium-6">
                    <img src="/images/noisedrops-light.svg" class="header__logo" alt="Noisedrops Logo"/>
                    <p>Drop some background noise to free yourself of distractions.</p>
                </div>
                <div class="column small-12 medium-6">
                    <div style="border: 2px dashed green;">Gad</div>
                </div>
            </div>
        </header>

        <div class="cards">
            <div class="row small-up-1 medium-up-3 large-up-4">
                <div class="column">
                    <div class="card">
                        <a href="javascript:;;" class="card__play--link show-for-medium">
                            <div class="card__main">
                                <div class="card__play util-absolute">
                                    <i class="fa fa-play-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <img src="//placekitten.com/500/325">
                            </div>
                        </a>
                        <div class="card-section">
                            <div class="show-for-small-only text-center">
                                <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                <hr>
                            </div>
                            <h4 class="card__title">Coffee Shop
                                <a class="card__link" href="javascript:;;"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <a href="javascript:;;" class="card__play--link show-for-medium">
                            <div class="card__main">
                                <div class="card__play util-absolute">
                                    <i class="fa fa-play-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <img src="//placekitten.com/500/325">
                            </div>
                        </a>
                        <div class="card-section">
                            <div class="show-for-small-only text-center">
                                <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                <hr>
                            </div>
                            <h4 class="card__title">
                                Coffee Shop
                                <a class="card__link" href="javascript:;;"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <a href="javascript:;;" class="card__play--link show-for-medium">
                            <div class="card__main">
                                <div class="card__play util-absolute">
                                    <i class="fa fa-play-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <img src="//placekitten.com/500/325">
                            </div>
                        </a>
                        <div class="card-section">
                            <div class="show-for-small-only text-center">
                                <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                <hr>
                            </div>
                            <h4 class="card__title">Coffee Shop
                                <a class="card__link" href="javascript:;;"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <a href="javascript:;;" class="card__play--link show-for-medium">
                            <div class="card__main">
                                <div class="card__play util-absolute">
                                    <i class="fa fa-play-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <img src="//placekitten.com/500/325">
                            </div>
                        </a>
                        <div class="card-section">
                            <div class="show-for-small-only text-center">
                                <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
                                <hr>
                            </div>
                            <h4 class="card__title">Coffee Shop
                                <a class="card__link" href="javascript:;;"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="row expanded align-center footer__section">
                <div class="column">
                    <a href="javascript:;;" class="footer__link"><i class="fa fa-google-plus-square fa-2x footer__icon" aria-hidden="true"></i></a>
                    <a href="javascript:;;" class="footer__link"><i class="fa fa-facebook-square fa-2x footer__icon" aria-hidden="true"></i></a>
                    <a href="javascript:;;" class="footer__link"><i class="fa fa-twitter-square fa-2x footer__icon" aria-hidden="true"></i></a>
                    <a href="javascript:;;" class="footer__link"><i class="fa fa-envelope-square fa-2x footer__icon" aria-hidden="true"></i></a>
                </div>
            </div>
        </footer>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
