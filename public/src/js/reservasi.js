$(function(){
    const keranjangPesanan = {
        items: [],
        total: 0,
        quantity: 0,
    
        tambahItem: function(id, nama, harga, stok) {
            const existingItem = this.items.find(item => item.id === id);
    
            if (existingItem && existingItem.jumlah + 1 > stok) {
                alert("Stok tidak mencukupi untuk item ini.");
                return;
            }
    
            if (existingItem) {
                existingItem.jumlah++;
            } else {
                this.items.push({
                    id: id,
                    nama: nama,
                    harga: harga,
                    jumlah: 1,
                    stok: stok
                });
            }
    
            this.perbaruiTampilan();
        },
    
        perbaruiTampilan: function() {
            const tbody = document.getElementById("tabel-keranjang").getElementsByTagName("tbody")[0];
            tbody.innerHTML = "";
    
            let rowIndex = 0;
    
            for (const item of this.items) {
                const row = tbody.insertRow(rowIndex);
                row.id = "row" + item.id;
    
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);
    
                cell1.innerHTML = item.nama;
    
                const input = document.createElement("input");
                input.type = "number";
                input.className = "w-50 form-control";
                input.id = item.id;
                input.name = item.id;
                input.value = item.jumlah;
    
                input.addEventListener("input", () => this.handleInputChange(input, item));
    
                cell2.appendChild(input);
    
                const deleteButton = document.createElement("button");
                deleteButton.className = "btn btn-danger";
                deleteButton.innerHTML = "×";
                deleteButton.id = "btn" + item.id;
                deleteButton.addEventListener("click", () => this.hapusItem(item.id));
    
                cell3.appendChild(deleteButton);
    
                rowIndex++;
            }
    
            this.updateTotalHarga();
        },
    
        handleInputChange: function(input, item) {
            if (input.value.trim() === "") return;
            if (input.value > item.stok) {
                alert("Stok sisa " + item.stok);
                input.value = item.stok;
            }
            item.jumlah = parseInt(input.value, 10);
            this.updateTotalHarga();
        },
    
        hapusItem: function(id) {
            const index = this.items.findIndex(item => item.id === id);
    
            if (index !== -1) {
                this.items.splice(index, 1);
                const rowToRemove = document.getElementById("row" + id);
                rowToRemove.remove();
                this.perbaruiTampilan();
            }
        },
    
        updateTotalHarga: function() {
            this.total = this.items.reduce((total, item) => total + item.harga * item.jumlah, 0);
            this.quantity = this.items.reduce((total, item) => total + item.jumlah, 0);
    
            const totalHargaElement = document.getElementById("total");
            const formatRupiah = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    
            totalHargaElement.value = formatRupiah(this.total);
        }
    };


$('.addTocart').on('click', function() {
                
    const id = $(this).data('id');
        $.ajax({
            url: '/getdata',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                keranjangPesanan.tambahItem(data.id, data.nama,  data.harga, data.stok); 
        }
    });
        
});


$('#checkout').on('click', function() {
    if($("#total").val()=="" || $("#total").val()=="Rp0") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Keranjang masih kosong'
          })
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
            
        const nomMeja = $("#meja").val();
        $.ajax({
            type: "POST",
            url: "/checkout",
            data: { menu_pesan: keranjangPesanan.items, total_harga: keranjangPesanan.total, no_meja: nomMeja },
            dataType: 'json',
            success: function(response) {
              console.log(response);
                if(response.error){
                    Swal.fire({
                        icon: 'warning',
                        title: response.error,
                        text: "Tunggu hingga pesanan sebelumnya di konfirmasi oleh admin"
                      })
                }else{
                    window.location.href="/checkout?id="+response.orderId;
                }
            }
        });
        }
      })
});



});