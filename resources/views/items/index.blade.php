


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand ml-3">Market Place</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse"></div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <a href="/checkout" class="btn menu-right-btn border">Keranjang Belanja</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid p-0">
            <div class="site-content">
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column text-center">
                        <h1 class="site-title">Marketplace</h1>
                        <p class="site-desc">Apa yang kamu butuhkan ada disini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-1">
            <div class="container text-center">
                <h1 class="heading-1">Koleksi</h1>
                <h1 class="heading-2">& Pilihan Produk</h1>

                <div class="row justify-content-center text-center">
                    @foreach ($items as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="image" class="card-image-top" />
                            <div class="card-body">
                                <h4 class="card-title">{{ $item->namabarang }}</h4>
                                <p class="card-text">{{ $item->deskripsi }}</p>
                                <p class="card-body">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <a href="{{ url('/pesan')}}/{{ $item->id }}" class="btn btn-primary addToCart" data-id="{{ $item->id }}">PESAN</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section-4">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ asset('storage/images/section-4.jpeg')}}" alt="section-4" width="100%" height="100%" />
                    </div>
                    <div class="col-md-7">
                        <h3 class="heading-1">Tentang Kami</h3>
                        <hr class="h-line-1" />
                        <br />
                        <p class="para-1">What is Lorem Ipsum?
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="section-5 text-center">
            <h4 class="footer-heading-2">Gempitarizki</h4>

            <div class="form-inline justify-content-center">
                <input type="text" name="Email" id="email" placeholder="gempitarizki6@gmail.com" size="40px;" class="form-control px-4 py-2" /> 
                <input type="button" value="Tulis pesan Anda di sini" class="btn btn-light px-4 py-2" />
            </div>

            <div class="social">
                <div class="d-flex justify-content-center">
                    <a href="https://github.com/GempitaRizki" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </div>
            </div>
            

            <hr>
            <h5 class="footer-heading">gmptrzki &copy;</h5>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
