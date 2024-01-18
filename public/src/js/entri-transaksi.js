$(function() {
    $('#uang_bayar').on('input', function () {
        hitungKembalian();
    });

   
    $('#bayar').on('click', function(){
        let uangBayarValue = $("#uang_bayar").val();
        let kembalian = hitungKembalian();
        let nomorMeja = parseInt($("tfoot th:contains('Nomor Meja')").next().text());
    let idorder = $('#totalHarga').data('id');
        if(kembalian>=0){
            $.ajax({
                type: "POST",
                url: "/entri-transaksi/bayar",
                data: { uang_bayar: uangBayarValue, uang_kembali: kembalian, idorder: idorder, noMeja: nomorMeja },
                success: function() {
                    window.location.href="/entri-transaksi";
                }
            });
        }else{
            alert("Uang belum cukup!");
        }
    });



    $('.hapus-order').on('click', function () {
        let idOrder = $(this).data('id');
        let nomorMeja = $(this).closest("tr").find("td:eq(0)").text();
        
        Swal.fire({
            title: 'Kamu yakin ingin hapus?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/entri-transaksi/hapus",
                    data: {id : idOrder, noMeja: nomorMeja},
                    dataType: 'json',
                    success: function(response) {
                        if(response.error){
                            Swal.fire({
                                icon: 'error',
                                title: response.error
                              })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: response.success
                              }).then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });

    $('.hapus-orderFix').on('click', function () {
        let idOrder = $(this).data('id');
        Swal.fire({
            title: 'Kamu yakin ingin hapus?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/entri-transaksi/selesai",
                    data: {id : idOrder},
                    dataType: 'json',
                    success: function(response) {
                        if(response.error){
                            Swal.fire({
                                icon: 'error',
                                title: response.error
                              })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: response.success
                              }).then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });

});

function hitungKembalian() {
    let uangBayar = $('#uang_bayar').val();
    let totalHarga = $('#totalHarga').data('total');

    let kembalian = uangBayar - totalHarga;
    
    if (kembalian >= 0) {
        $('#uang_kembali').val(formatRupiah(kembalian));
    } else {
        $('#uang_kembali').val(formatRupiah(0));
    }
    return kembalian;
}

const formatRupiah = (number)=>{
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', 
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
};
