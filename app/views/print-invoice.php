<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        #seller-info,
        #total-and-print {
            margin-bottom: 20px;
        }

        #seller-info {
            text-align: center;
            margin: 0 auto;
            max-width: 600px;
        }


        #invoice {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }
        tfoot>tr>th {
            text-align: right;
        }

        button, a {
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 20px;
            float: right;
        }
        a{            
            background-color: red;
            text-decoration: none;
        }
        button{            
            background-color: #4CAF50;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Print Styles */
        @media print {
            @page {
                size: 80mm 170mm;
                margin: 3mm;
            }

            body {
                margin: 0;
                padding: 0;
            }
            button, a {
                display: none;
            }

            .container {
                width: 100%;
            }

            #invoice {
                border: none;
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Informasi Penjual -->
        <div id="seller-info" class="container mt-5">
            <h1>FOODHUNT</h1>
            <p>Alamat: Jl. Perintis Kemerdekaan No.KM.9, Tamalanrea Indah, Kec. Tamalanrea, Kota Makassar, Sulawesi Selatan 90245</p>
            <p>Email: foodhuntkami@gmail.com</p>
            <p>Telepon: +62 81354334173</p>
        </div>

        <!-- Invoice Content -->
        <div id="invoice" class="card-body">
            <!-- Informasi Pembeli -->
            <div id="buyer-info">
                <h5>Nama Pembeli: <?= $data['order']->namaPengunjung ?></h5>
                <h5>waktu pesan: <?= $data['order']->waktuPesan ?></h5>
            </div>

            <!-- Order Table -->
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th>QTY</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['pesanan'] as $pesanan) : ?>
                    <tr class="text-center">
                        <td><?= $pesanan->jumlah ?></td>
                        <td><?= $pesanan->menuNama ?></td>
                        <td><?= formatRupiah($pesanan->menuHarga) ?></td>
                        <td><?= formatRupiah($pesanan->subTotal) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="3">Total</th>
                        <td>
                            <?= formatRupiah($data['order']->totalHarga) ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">Nomor Meja</th>
                        <td><?= $data['order']->noMeja ?></td>
                    </tr>
                </tfoot>
            </table>
            <!-- /Order Table -->
        </div>
        <!-- /Invoice Content -->
        <!-- Tombol Print -->
        <button onclick="window.print()">Cetak</button>
        <!-- Tombol cancel -->
        <a href="/entri-transaksi">Kembali</a>
    </div>
</body>

</html>