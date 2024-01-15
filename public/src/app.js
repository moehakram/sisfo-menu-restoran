$(function () {

      const keranjangPesanan = {
        items: [],
        total: 0,
        quantity: 0,
        noMeja: 0,

        add: function(newItem) {
            const cartItem = this.items.find((item) => item.id === newItem.id);
        
            if (!cartItem) {
                this.items.push({ ...newItem, jumlah: 1, subtotal: newItem.harga });
                this.quantity++;
                this.total += newItem.harga;
            } else {
                // Check if adding more exceeds stok
                if (cartItem.jumlah + 1 > newItem.stok) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Maaf...',
                        text: 'Stok tidak mencukupi'
                    });
                    return;
                }
        
                this.items = this.items.map((item) => {
                    if (item.id !== newItem.id) {
                        return item;
                    } else {
                        item.jumlah++;
                        item.subtotal = item.harga * item.jumlah;
                        this.quantity++;
                        this.total += item.harga;
                        return item;
                    }
                });
            }
            perbaruiTampilan();
        },
        
        remove: function(id){
            const cartItem = this.items.find((item) => item.id === id);
            if(cartItem.jumlah > 1){
                this.items = this.items.map((item)=>{
                    if(item.id !== id){
                        return item;
                    }else{
                        item.jumlah--;
                        item.subtotal = item.harga*item.jumlah;
                        this.quantity--;
                        this.total -= item.harga;
                        return item;
                    }
                })
            }
            perbaruiTampilan();
        },

        hapusItem: function (id) {
            const index = this.items.findIndex(item => item.id === id);
            if (index !== -1) {
                const deletedItem = this.items.splice(index, 1)[0];
                this.quantity -= deletedItem.jumlah;
                this.total -= deletedItem.subtotal;
            }
            perbaruiTampilan();
        }
    };


$('.boton-item').on('click', function () {
    // Check if the table has been selected
    if (keranjangPesanan.noMeja) {
        const id = $(this).data('id');
        $.ajax({
            url: '/getdata',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                keranjangPesanan.add(data);
            }
        });
    } else {
        const id = $(this).data('id');
        $.ajax({
            url: '/getTableNumbers',
            method: 'get',
            dataType: 'json',
            success: function (tableNumbers) {
                if (tableNumbers.length > 0) {
                    const tableOptions = {};

                    tableNumbers.forEach(tableNumber => {
                        tableOptions[tableNumber.nomor] = `Meja ${tableNumber.nomor}`;
                    });

                    Swal.fire({
                        title: 'Pilih nomor meja:',
                        input: 'select',
                        inputOptions: tableOptions,
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        showLoaderOnConfirm: true,
                        preConfirm: (selectedTable) => {
                            return new Promise((resolve) => {
                                setTimeout(() => {
                                    resolve(selectedTable);
                                }, 100);
                            });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                         
                            $.ajax({
                                url: '/getdata',
                                data: { id: id},
                                method: 'post',
                                dataType: 'json',
                                success: function (data) {
                                    keranjangPesanan.noMeja = result.value;
                                    $('.nMeja').text(keranjangPesanan.noMeja);        
                                    keranjangPesanan.add(data);
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Maaf...',
                        text: 'Tidak ada nomor meja yang tersedia.'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Maaf...',
                    text: 'Gagal mengambil data nomor meja dari server.'
                });
            }
        });
    }
});

    $('.btn-pagar').on('click', function () {
        if (keranjangPesanan.quantity == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Keranjang masih kosong'
            });
            return;
        }

        Swal.fire({
            title: 'Anda yakin ingin Checkout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Checkout'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/checkout",
                    data: { menu_pesan: keranjangPesanan.items, total_harga: keranjangPesanan.total, no_meja: keranjangPesanan.noMeja },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            Swal.fire({
                                icon: 'warning',
                                title: response.error,
                                text: "Tunggu hingga pesanan sebelumnya di konfirmasi oleh admin"
                            });
                        } else {
                            window.location.href = "/checkout?id=" + response.orderId;
                        }
                    }
                });
            }
        });
    });

    function showCart() {
        const carrito = document.querySelector('.carrito');
        carrito.classList.add('carrito-visible');
        const cart = document.querySelector('li.tag');
        cart.classList.add('tag-cart');
      }
  
    function hideCart() {
        keranjangPesanan.noMeja = 0;
        const carrito = document.querySelector('.carrito');
        carrito.classList.remove('carrito-visible');
        const cart = document.querySelector('li.tag');
        cart.classList.remove('tag-cart');
      }

    // Update the cart display
    function perbaruiTampilan() {
        if(keranjangPesanan.quantity){
            showCart();
        }else{
            hideCart();
        }
        let itemsCarrito = document.getElementsByClassName('carrito-items')[0];
        itemsCarrito.innerHTML = "";

        keranjangPesanan.items.forEach(item => {
            let itemElement = document.createElement('div');
            itemElement.classList.add('carrito-item');
            let itemCarritoContenido = `
                <div class="carrito-item-detalles">
                    <span class="carrito-item-titulo">${item.nama}</span>
                    <span class="carrito-item-precio">${formatRupiah(item.harga)}</span> &times;
                    <div class="selector-cantidad">
                        <i class="fa-solid fa-minus restar-cantidad"></i>
                        <input type="text" value="${item.jumlah}" class="carrito-item-cantidad" disabled>
                        <i class="fa-solid fa-plus sumar-cantidad"></i>
                    </div>=
                    <span class="carrito-item-precio">${formatRupiah(item.subtotal)}</span>
                </div>
                <button class="btn-eliminar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            itemElement.innerHTML = itemCarritoContenido;
            itemsCarrito.appendChild(itemElement);

            // Add functionality to delete the item
            itemElement.getElementsByClassName('btn-eliminar')[0].addEventListener('click', () => keranjangPesanan.hapusItem(item.id));

            // Add functionality to decrease quantity of the item
            const botonminItem = itemElement.getElementsByClassName('restar-cantidad')[0];
            botonminItem.addEventListener('click', () => keranjangPesanan.remove(item.id));

            // Add functionality to increase quantity of the item
            const botonaddItem = itemElement.getElementsByClassName('sumar-cantidad')[0];
            botonaddItem.addEventListener('click', () => keranjangPesanan.add(item));

        });
        const totalHargaElement = document.getElementById("total");
        totalHargaElement.innerText = formatRupiah(keranjangPesanan.total);
        console.log(keranjangPesanan.items);
    }


    const formatRupiah = (number)=>{
        return new Intl.NumberFormat('id-ID', {
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    };
    

});
