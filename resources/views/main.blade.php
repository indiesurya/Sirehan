<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SIREHAN</title>

    <style>
        body {
            font-family: 'Merriweather', serif;
        }
        .carousel::after {
            background-image: linear-gradient(to top, rgb(0, 0, 53) 0%, rgba(0,0,0,0));
            bottom: 0;
            content: "";
            height: 70%;
            left: 0;
            position: absolute;
            right: 0;
        }
        .carousel-caption{
            z-index: 999;
        }
        .img{
            width: 500px;
        }
        .row p{
            text-align: justify;
        }
        .fitur {
            background-image: url(/img/carousel2.jpg);
            background-size: cover;
            height: auto;
            position: relative;
        }
        .fitur::after{
            background-color: rgba(0, 0, 53, 0.5);
            bottom: 0;
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
        }
        @media screen and (min-width: 768px){
            footer ul{
                justify-content: end;
            }
        }
        @media screen and (max-width: 768px){
            .img{
            width: 0;
            }
            footer p{
                text-align: center;
            }
            footer ul{
                justify-content: center;
            }
        }
        @media screen and (max-width: 579px){
            .fitur .container{
                position: relative;
                z-index: 999;
                margin-left:0 !important;
            }
            .features .row .col-sm-12{
                margin-bottom: 20px;
            }
            
        }
        @media screen and (max-width: 575px){
            footer{
                justify-content: center;
            }
        }
        .fitur .container{
            position: relative;
            z-index: 999;
        }
        .features{
            height: auto;
            background-color: aliceblue;
            border-radius: 20px;
            padding-top:20px;
            padding-bottom:20px;
            position: relative;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">SIREHAN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                <a class="nav-link" href="#">About</a>
                <a class="nav-link" href="#">Features</a>
                <a class="nav-link" href="#">Gallery</a>
            </div>
            </div>
        </div>
    </nav>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="img/carousel1.jpg" class="d-block w-100"alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>  
            <p>Some representative placeholder content for the first slide.</p>
        </div>
        </div>
        <div class="carousel-item">
        <img src="img/carousel6.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
        </div>
        </div>
        <div class="carousel-item">
        <img src="img/carousel3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    <div class="container mt-5 mb-5 pt-1">
        <div class="row">
            <div class="col-sm-12 col-lg-7">
                <h1 class="fw-bold fst-italic mt-5 mb-3">SIREHAN</b></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae aliquam nobis fuga, ratione ipsa possimus fugiat quae accusantium tempora atque ullam dicta odio beatae esse, nemo distinctio dolores quo totam mollitia commodi nulla, sapiente cum. Porro nisi quia ullam sint officia, quis iure cum laboriosam deleniti at iusto, officiis eos!</p>
                <a class="btn btn-primary" href="/dashboard" role="button">Kunjungi</a>
                <button type="button" class="btn btn-outline-primary">Daftar atau Masuk</button>
            </div>
            <div class="col-lg-5">
                <img src="/img/hp3.jpg" class="img mx-auto d-block" alt="">
            </div>
        </div>
    </div>
    <div class="fitur">
        <div class="container">
            <div class="row">
                <h1 class="text-white text-center mt-4 mb-2">Features</h1>
                <div class="features mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-1 mb-2">
                            <div class="card">
                                <img src="img/hp1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Pencarian</b></h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/pencarian" class="btn btn-primary">Kunjungi</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-1 mb-2">
                            <div class="card">
                                <img src="img/hp1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Rekomendasi</b></h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/rekomendasi" class="btn btn-primary">Kunjungi</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-1 mb-2">
                            <div class="card">
                                <img src="img/hp1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Penjelajahan</b></h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/penjelajahan" class="btn btn-primary">Kunjungi</a>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery mt-4 mb-5 pt-1">
        <div class="container">
            <div class="gallery">
                <h1 class="mb-5 text-center">Gallery</h1>
                <div class="row">
                    <?php for ($i=0; $i <8; $i++) : ?>
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card mb-3">
                        <img src="img/carousel1.jpg" class="card-img-top"style="height:200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">POCO X3 NFC</h5>
                            <p class="card-text fw-lighter fs-6">Xiaomi</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid shadow-lg pb-1">
        <footer class="d-flex flex-wrap align-items-center py-3 my-4 border-top">
            <p class="col-md-4 col-sm-12 mb-0 text-muted">&copy; 2021 Company, Inc</p>

            <ul class="nav col-md-4 col-sm-12 offset-md-4">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>