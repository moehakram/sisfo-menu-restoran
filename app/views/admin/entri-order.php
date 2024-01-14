<!-- Begin Page Content -->
<div class="container px-1">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menu</h1>
    <p class="mb-4">Silahkan Di Chekout untuk melakukan pemesanan.</p>
    <p class="mb-4">Halaman ini digunakan saat pelanggan pesan langsung di tempat. Dibuka oleh admin atau kasir restoran kami
    </p>

    <!-- Makanan -->
    <div class="row">
        <div class="col-8 px-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Menu Makanan</h6>
                </div>
                <div class="card-body">

                    <!-- container  -->
                    <div class="container px-1">
                        <!-- col-1 -->
                        <div class="d-flex flex-wrap">
                            <!-- ... -->

                            <?php foreach($data['makanan'] as $makanan): ?>
                            <div class="card p-1 m-1" style="width: 14rem;">
                                <img src="<?= SRC_UPLOAD.'entri-makanan/'.$makanan['213049_menu_gambar']; ?>"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?= $makanan["213049_menu_nama"] ; ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Harga/Porsi <div class="float-right">
                                            <?= formatRupiah($makanan["213049_menu_harga"]) ; ?></div>
                                    </li>
                                    <li class="list-group-item">Stok <div class="float-right">
                                            <?= $makanan["213049_menu_stok"] ; ?></div>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <button type="button" data-id="<?= $makanan['213049_id']; ?>"
                                        class="btn btn-primary addTocart float-right"
                                        <?= ($makanan['213049_menu_stok'] == 0) ? 'disabled': ''; ?>>pesan</button>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- /... -->
                        </div>

                        <!-- /col-1  -->
                    </div>

                </div>
            </div>
            <!-- /container  -->
        </div>
        <div class="col-4 px-1">
            <!-- col-2  -->
            <div class="card">
                <h5 class="card-header">Keranjang Pemesanan</h5>
                <div class="card-body px-2">
                    <!-- awal tabel keranjang -->
                    <table class="border-collapse border border-slate-400" id="tabel-keranjang">
                        <thead>
                            <tr class="border text-center">
                                <th>Menu pesanan</th>
                                <th>Jumlah</th>
                                <th>hapus</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Total Harga</th>
                                <th><input type="text" class="form-control text-right w-75" disabled="disabled"
                                        id="total" placeholder="Rp-"></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th><label for="meja">Nomor Meja</label></th>
                                <th colspan="2"><select class="form-control w-75" id="meja">
                                        <!-- <option value=0>--pilih--</option> -->
                                        <?php foreach ($data['meja'] as $meja): ?>
                                        <option value="<?= $meja['213049_no_meja']; ?>"
                                            <?= ($meja['213049_no_meja'] == ($_SESSION['no_meja']??0)) ? 'selected' : ''; ?>
                                            <?= ($meja['213049_status_meja'] == '2') ? 'disabled' : ''; ?>>
                                            <?= 'MEJA ' . $meja['213049_no_meja'] . ': ' . ($meja['213049_status_meja'] == '1' ? 'tersedia' : 'tidak tersedia'); ?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select></th>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- <a role="button" href="/entri-order/checkout" class="btn btn-primary float-right mt-2"
                        id="checkout">Checkout</a> -->
                    <button type="button" class="btn btn-primary float-right mt-2" id="checkout">Checkout</button>
                </div>
            </div>
            <!-- /col-2 -->
        </div>
    </div>
    <!-- / akhir makanan  -->
    <!-- Minuman -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menu minuman</h6>
        </div>
        <div class="card-body">

            <!-- container  -->
            <div class="container px-1">

                <div class="d-flex flex-wrap">
                    <!-- ... -->

                    <?php foreach($data['minuman'] as $minuman): ?>
                    <div class="card p-1 m-1" style="width: 14rem;">
                        <img src="<?= SRC_UPLOAD.'entri-minuman/'.$minuman['213049_menu_gambar']; ?>"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $minuman["213049_menu_nama"] ; ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Harga/Porsi <div class="float-right">
                                    <?= formatRupiah($minuman["213049_menu_harga"]) ; ?></div>
                            </li>
                            <li class="list-group-item">Stok <div class="float-right">
                                    <?= $minuman["213049_menu_stok"] ; ?></div>
                            </li>
                        </ul>
                        <div class="card-body">
                            <button type="button" data-id="<?= $minuman['213049_id']; ?>"
                                class="btn btn-primary addTocart float-right"
                                <?= ($minuman['213049_menu_stok'] == 0) ? 'disabled': ''; ?>>pesan</button>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <!-- /... -->
                </div>

            </div>
            <!-- /container  -->
        </div>
    </div>
    <!-- / akhir Minuman  -->

</div>
<!-- /.container-fluid -->