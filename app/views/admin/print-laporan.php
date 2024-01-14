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
                size: A4;
                margin: 2cm;
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
            <p>Alamat: Jl. Perintis Kemerdekaan No.KM.9, Tamalanrea Indah, Kec. Tamalanrea,
Kota Makassar, Sulawesi Selatan 90245</p>
            <p>Email: foodhuntkami@gmail.com</p>
            <p>Telepon: +62 8125507527</p>
        </div>

        <!-- Invoice Content -->
        <div id="invoice" class="card-body">
            <!-- Informasi Pembeli -->
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Menu</th>
                            <th>Sisa Stok</th>
                            <th>Jumlah Terjual</th>
                            <th>Harga</th>
                            <th>Total Pemasukan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i=1; $total=0; foreach($data['laporan'] as $laporan): ?>
                        <tr>
                            <td><?= $i++."." ?></td>
                            <td><?= $laporan['nama_menu'] ?></td>
                            <td><?= $laporan['sisa_stok'] ?></td>
                            <td><?= $laporan['jumlah_terjual'] ?></td>
                            <td><?= formatRupiah($laporan['harga_satuan']) ?></td>
                            <td><?= formatRupiah($laporan['sub_total']) ?></td>
                        </tr>
                        <?php $total += $laporan['sub_total']; endforeach;?>
                    </tbody>
                    <tfoot>
                        <tr>

                            <th colspan="5" class="text-right">Total Pemasukan</th>
                            <th><?= formatRupiah($total) ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-xl-3">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">PEMASUKAN</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= formatRupiah($total) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /Invoice Content -->
        <!-- Tombol Print -->
        <button onclick="window.print()">Print laporan</button>
        <!-- Tombol cancel -->
        <a href="/generate-laporan">cancel</a>
    </div>
</body>

</html>