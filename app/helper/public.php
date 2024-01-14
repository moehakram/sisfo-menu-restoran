<?php

function formatRupiah($angka):string {
    return "Rp" . number_format($angka, 0, ',', '.');
};
