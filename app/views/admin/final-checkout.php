<!-- Begin Page Content -->
<div class="container px-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Menu Bayar</h1>
    <!-- <p class="mb-4">Selamat datang di halaman daftar pesanan. Berikut adalah rincian pesanan yang telah Anda buat.</p> -->

    <!-- Notifikasi -->
    <div class="row">
        <!-- Menu Yang Dipesan -->
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Menu Yang Dipesan</h5>
                <div class="card-body px-3">
                    <!-- Tabel Pesanan -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Harga per Porsi</th>
                                <th>SubTotal Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($data['pesanan'] as $pesanan ) : ?>
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td><?= $pesanan['nama_menu'] ?></td>
                                <td><?= $pesanan['jumlah'] ?></td>
                                <td><?= formatRupiah($pesanan['harga_satuan']) ?></td>
                                <td><?= formatRupiah($pesanan['sub_total']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th colspan="4">Total Harga</th>
                                <td id="totalHarga" data-id="<?= $_GET['id'] ?>" data-total="<?= $data['pesanan'][0]['total'] ?>"><?= formatRupiah($data['pesanan'][0]['total']) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4">Nomor Meja</th>
                                <td><?= $data['pesanan'][0]['no_meja'] ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- /Tabel Pesanan -->
                </div>
                <!-- awal -->

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Membayar: Rp</span>
                    </div>
                    <input type="number" name="uang_bayar" id="uang_bayar" class="form-control" placeholder="input jumlah uang">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Kembalian: Rp</span>
                    </div>
                    <input type="text" name="uang_kembali" readonly id="uang_kembali" class="form-control" placeholder="kembalian">
                </div>
                <!-- /awal -->
            </div>
            <button type="button" id="bayar" class="btn btn-primary w-20 float-right mt-2">bayar</button>
            <a role="button" href="/entri-transaksi" class="btn btn-danger mr-4 w-20 float-right mt-2">cancel</a>
     
        </div>
        <!-- /Menu Yang Dipesan -->
    </div>
    <!-- /Row -->

</div>
<!-- /.container-fluid -->



