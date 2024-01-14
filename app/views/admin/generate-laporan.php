<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Generate Laporan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pemasukan</h6>
            
        </div>
        <div class="card-body">
            <a href="/generate-laporan/print?id=" class="btn btn-success mb-3 float-right">Cetak Laporan</a>
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

</div>
<!-- /.container-fluid -->