<div class="xheader">
    <h1>FOOD HUNT</h1>
</div>
<section class="menu">
    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-makanan">
                    <h4>Makanan</h4>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-minuman">
                    <h4>Minuman</h4>
                </a>
            </li>
            <li class="nav-item tag">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#carrito">
                    <h4><i class="fa-solid fa-shopping-cart"></i></h4>
                </a>
            </li>
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
            <div class="tab-pane fade active show" id="menu-makanan">
                <div class="tab-header text-center">
                    <h3>Makanan</h3>
                </div>
                <div class="contenedor">
                    <!-- Contenedor de elementos -->
                    <div class="contenedor-items">
                        <?php foreach($data['makanan'] as $makanan): ?>
                        <div class="item">
                            <span class="titulo-item"><?= $makanan->nama ; ?></span>
                            <img src="<?= SRC_UPLOAD.'entri-makanan/'.$makanan->gambar; ?>" alt=""
                                class="img-item">
                            <span class="stok-item">STOK : <?=$makanan->stok; ?></span>
                            <span class="precio-item"><?= formatRupiah($makanan->harga) ; ?></span>
                            <button class="boton-item" <?= ($makanan->stok == 0) ? 'disabled': ''; ?>
                                data-id="<?= $makanan->id; ?>">add</button>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade active show" id="menu-minuman">
                <div class="tab-header text-center">
                    <h3>Minuman</h3>
                </div>
                <div class="contenedor">
                    <!-- Contenedor de elementos -->
                    <div class="contenedor-items">
                        <?php foreach($data['minuman'] as $minuman): ?>
                        <div class="item">
                            <span class="titulo-item"><?= $minuman->nama ; ?></span>
                            <img src="<?= SRC_UPLOAD.'entri-minuman/'.$minuman->gambar; ?>" alt=""
                                class="img-item">
                            <span class="stok-item">STOK : <?=$minuman->stok ; ?></span>
                            <span class="precio-item"><?= formatRupiah($minuman->harga) ; ?></span>
                            <button class="boton-item" <?= ($minuman->stok == 0) ? 'disabled': ''; ?>
                                data-id="<?= $minuman->id; ?>">add</button>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Carrito de Compras -->
    <div class="carrito" id="carrito">
        <div class="header-carrito">
            <h2>Your Cart</h2>
        </div>
        <div class="carrito-items">
        </div>
        <div class="carrito-total">
            <div class="fila">
                <strong>Total</strong>
                <span class="carrito-precio-total" id="total"></span>
            </div>
            <div class="fila">
                <strong class="meja">No. Meja</strong>
                <span class="carrito-option nMeja"></span>
            </div>
            <button class="btn-pagar">checkout now<i class="fa-solid fa-bag-shopping"></i></button>
        </div>
    </div>
</section>

