<!-- Begin Page Content -->
<section>
    <div class="container" data-aos="fade-up">
        <!-- Page Heading -->
        <h1 class="h3 my-3 text-gray-800">Menu Yang dipesan</h1>
        <!-- Menu Yang Dipesan -->

        <div class="card shadow">
            <div class="row">
                <!-- <h5 class="card-header">Menu Yang Dipesan</h5> -->
                <div class="col-md-8 mt-2">
                    <div class="card-body">
                        <!-- Informasi Pembeli -->
                        <div id="buyer-info">
                            <h6>Nama Pembeli: <?= $data['user']['name'] ?></h6>
                            <h6>waktu pesan: <?= $data['order']->waktuPesan ?></h6>
                        </div>
                        <!-- Order Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>QTY</th>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['pesanan'] as $pesanan ) : ?>
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
                                    <th colspan="3">Total tagihan</th>
                                    <th>
                                        <?= formatRupiah($data['order']->totalHarga) ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3">Nomor Meja</th>
                                    <th><?= $data['order']->noMeja ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- /Order Table -->
                        <!-- qr-code -->
                        <!-- qr-code -->
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="card-body">
                        <!-- Container Notifikasi -->
                        <div class="container">
                            <!-- Notifikasi Berhasil -->
                            <div class="alert alert-success" role="alert">
                                <!-- <h4 class="alert-heading">Selamat!</h4> -->
                                <p>Silakan tunjukkan QR-code ke staf kami</p>
                                <hr>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= '<<ID>>'.$_GET['id']?>"
                                    class="card-img-top" alt="qr-code">
                            </div>
                            <!-- /Notifikasi Berhasil -->
                        </div>
                        <!-- /Container Notifikasi -->
                    </div>
                </div>

            </div>
        </div>
        <!-- /Menu Yang Dipesan -->

        <!-- /Row -->
    </div>
</section>
<!-- /.container-fluid -->