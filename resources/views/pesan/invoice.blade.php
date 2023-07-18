<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Invoice</title>

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

    .invoice-logo {
      max-width: 100px;
      height: auto;
    }

    .invoice-header {
      display: flex;
      align-items: center;
    }

    .invoice-header .invoice-logo {
      margin-right: 10px;
    }

    .invoice-title {
      font-size: 24px;
      font-weight: bold;
    }

    .invoice-info {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .invoice-info span {
      display: block;
    }

    .invoice-table {
      margin-top: 20px;
    }

    .invoice-table th,
    .invoice-table td {
      padding: 8px;
    }

    .invoice-table th {
      text-align: left;
    }

    .invoice-total {
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
      text-align: right;
    }

    .checkout-btn {
      margin-top: 20px;
      text-align: right;
    }

    .checkout-btn .btn {
      margin-left: 10px;
    }

  </style>
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap-shopping-carts.min.css') }}" />
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="invoice-header">
          <img src="{{ asset('images/invoice.png') }}" alt="Invoice Logo" class="invoice-logo">
          <div>
            <div class="invoice-title">Invoice</div>
            <div class="invoice-info">
              @if(!empty($pesanan))
              <span>Tanggal Pesan: {{ $pesanan->tanggal }}</span>
            </div>
          </div>
        </div>

        <div class="invoice-table">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
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
              </tr>
              <?php $total_harga += $pesanandetail->jumlah_harga; ?>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="invoice-total">
          Total Harga: Rp. {{ number_format($total_harga) }}
        </div>

        <div class="checkout-btn">
          <a href="#" class="btn btn-primary">Download Invoice (PDF)</a>
        </div>
        @endif
      </div>
    </div>
  </div>
</body>

</html>
