<?php

function formatRupiah($angka):string {
    return "Rp" . number_format($angka, 0, ',', '.');
};

function cetak($arr){
    echo '<pre>';
        print_r($arr);
    echo '</pre>';
}