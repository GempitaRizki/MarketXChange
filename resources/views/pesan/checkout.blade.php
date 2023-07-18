<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Keranjang</title>

  <style>
    .checkout-container {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
    }

    .checkout-container .total-harga {
      margin-right: auto;
    }

  </style>
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-shopping-carts.min.css') }}" />
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="/item" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
      </div>
      <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/item">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Check Out</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3><i class="fa fa-shopping-cart"></i> Check Out</h3>
            @if(!empty($pesanan))
            <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; $total_harga = 0; ?>
                @foreach($pesanandetails as $pesanandetail)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $pesanandetail->item->image) }}" width="100" alt="...">
                  </td>
                  <td>{{ $pesanandetail->item->namabarang }}</td>
                  <td>{{ $pesanandetail->jumlah }}</td>
                  <td align="right">Rp. {{ number_format($pesanandetail->item->harga) }}</td>
                  <td align="right">Rp. {{ number_format($pesanandetail->jumlah_harga) }}</td>
                  
                  <td>
                    <form action="{{ url('/checkout') }}/{{ $pesanandetail->id }}" method="post">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </td>
                  
                </tr>
                <?php $total_harga += $pesanandetail->jumlah_harga; ?>
                @endforeach
              </tbody>
            </table>

            <div class="checkout-container">
              <h4 class="total-harga">Total Harga: Rp. {{ number_format($total_harga) }}</h4>
              <a href="/invoice" class="btn btn-success">Checkout</a>
            </div>

            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
