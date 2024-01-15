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
            tampilan();
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
            tampilan();
        },

        hapusItem: function (id) {
            const index = this.items.findIndex(item => item.id === id);
            if (index !== -1) {
                const deletedItem = this.items.splice(index, 1)[0];
                this.quantity -= deletedItem.jumlah;
                this.total -= deletedItem.subtotal;
            }
            tampilan();
        },

        updateTotalHarga: function() {
            this.total = this.items.reduce((total, item) => total + item.harga * item.jumlah, 0);
            this.quantity = this.items.reduce((total, item) => total + item.jumlah, 0);
        
            const totalHargaElement = $("#total"); // Update this line to use jQuery selector
            const formatRupiah = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
        
            totalHargaElement.val(formatRupiah(this.total)); // Update this line to use .val() instead of .value
        }
        
    };

    $('.addTocart').on('click', function () {
        // Check if the table has been selected
        if (keranjangPesanan.noMeja) {
            const id = $(this).data('id');
            $.ajax({
                url: '/entri-order/getdata',
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

    $('#checkout').on('click', function () {
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
                    url: "/entri-order/checkout",
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
                            window.location.href="/entri-order/checkout?id="+response.orderId;
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

    function tampilan() {
        const tbody = $("#tabel-keranjang tbody");
        tbody.empty();
    
        let rowIndex = 0;
    
        keranjangPesanan.items.forEach(item => {
            const row = $("<tr></tr>").attr("id", "row" + item.id);
    
            const cell1 = $("<td></td>").text(item.nama);
            const cell2 = $("<td></td>");
    
            const input = $("<input>")
                .attr("type", "number")
                .addClass("w-50 form-control")
                .attr("id", item.id)
                .attr("name", item.id)
                .val(item.jumlah)
                .on("input", () => keranjangPesanan.handleInputChange(input, item));
    
            cell2.append(input);
    
            const cell3 = $("<td></td>");
    
            const deleteButton = $("<button></button>")
                .addClass("btn btn-danger")
                .html("×")
                .attr("id", "btn" + item.id)
                .on("click", () => keranjangPesanan.hapusItem(item.id));
    
            cell3.append(deleteButton);
    
            row.append(cell1, cell2, cell3);
            tbody.append(row);
    
            rowIndex++;
        });
        keranjangPesanan.updateTotalHarga();
    
    
        // Update Nomor Meja in the footer
        const nomorMejaSelect = $("#meja");
        nomorMejaSelect.val(keranjangPesanan.noMeja);
    }
    

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    };

});
