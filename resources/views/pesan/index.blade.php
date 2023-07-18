<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Diego Luiz">
  <meta name="description" content="A responsive, mobile first e-commerce product page built according to the challenge by Frontend Mentor, using HTML, CSS and Javascript">
  <meta name="keywords" content="html, css, javascript, e-commerce, product, page, challenge, frontend mentor, frontend, web developer, responsive, mobile first">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <script src="{{ asset('js/products.js') }}"></script>
  <script src="{{ asset('js/cart.js') }}"></script>
  <script src="{{ asset('js/focusable-lightbox.js') }}"></script>
  <script src="{{ asset('js/main.js') }}" defer></script>
  <title>Marketplace Gempita</title>
</head>
<body>
  <header class="top-header">
    <section class="cart-section" id="cart-section" aria-live="polite">
      <h3 class="cart-section__title">Cart</h3>
      <div class="cart-section__body">
        <p class="empty-msg">Your cart is empty.</p>
        <ul class="cart-section__products"></ul>
        <button type="button" class="cart-section__btn-checkout">Checkout</button>
      </div>
    </section>
  </header>

  <main>
    <article class="product">
      <section class="product__slider default-container" aria-label="Product preview">
        <button type="button" class="product__slider___btn-close-lightbox">
          <span class="sr-only">Close lightbox</span>
          <span class="icon icon-close" aria-hidden="true"></span>
        </button>  
        <div class="image-box" aria-label="Product preview" role="region">
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->namabarang }}" class="image-box__src" data-product-id="item-cart-1" tabindex="0" aria-controls="lightbox" aria-expanded="false">
          </div>
      </section>
      <section class="product__content default-container" aria-label="Product content">
        <header>
            <h2 class="company-name" tabindex="0">{{ $item->namabarang }}</h2>
          <h3 class="product__title" tabindex="0">keterangan</h3>
        </header>
        <p class="product__description" tabindex="0">
            {{ $item->deskripsi }}
        </p>
        <div class="product__price">
          <div class="discount-price">
            <p class="discount-price__value" tabindex="0">
              {{ 'Rp' . number_format($item->harga, 2, ',', '.') }}
              <span class="sr-only">rupiah</span>
            </p>
          </div>
        </div>
        <input type="hidden" name="harga" value="{{ $item->harga }}">
        <input type="hidden" name="barang_id" value="{{ $item->id }}">

        <form method="POST" action="{{ url('/pesan')}}/{{ $item->id }}" class="cart-form" id="cartForm">
          @csrf
          <div class="cart-form__input-container" aria-label="Define the product quantity">
            <button type="button" class="btn-changeValue minus-item">
              <span class="sr-only">kurang satu item</span>
              <span class="icon icon-minus" aria-hidden="true"></span>
            </button>
            <label for="product__quantity" class="sr-only">Set the quantity manually</label>
            <input type="number" min="0" value="0" id="product__quantity" data-product-id="{{ $item->id }}">
            <button type="button" class="btn-changeValue plus-item">
              <span class="sr-only">tambah satu item</span>
              <span class="icon icon-plus" aria-hidden="true"></span>
            </button>
          </div>
          <button type="submit" class="cart-form__add-btn" id="addToCartBtn">
            <span class="icon icon-cart" aria-hidden="true"></span>
            Masukan Keranjang
          </button>
        </form>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const minusBtn = document.querySelector(".minus-item");
            const plusBtn = document.querySelector(".plus-item");
            const quantityInput = document.querySelector("#product__quantity");
            const cartForm = document.getElementById('cartForm');
            const addToCartBtn = document.getElementById('addToCartBtn');
            const productQuantityInput = document.getElementById('product__quantity');
      
            let currentQuantity = parseInt(quantityInput.value);
      
            minusBtn.addEventListener("click", function () {
              updateQuantity(-1);
            });
      
            plusBtn.addEventListener("click", function () {
              updateQuantity(1);
            });
      
            function updateQuantity(value) {
              currentQuantity += value;
              if (currentQuantity < 0) {
                currentQuantity = 0;
              }
              quantityInput.value = currentQuantity;
            }
      
            addToCartBtn.addEventListener('click', function () {
              const quantityValue = productQuantityInput.value;
      
              const quantityInput = document.createElement('input');
              quantityInput.type = 'hidden';
              quantityInput.name = 'product__quantity';
              quantityInput.value = quantityValue;
      
              cartForm.appendChild(quantityInput);
            });
          });
        </script>
      </body>
      </html>
