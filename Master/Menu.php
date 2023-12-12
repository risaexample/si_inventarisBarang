<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/inventaris/index.php?target=";
        $data = [
            array('text' => 'Beranda', 'link' => $base . 'beranda'),
            array('text' => 'Inventaris', 'link' => $base . 'inventaris'),
            array('text' => 'Admin', 'link' => $base . 'admin'),
            array('text' => 'Peminjaman', 'link' => $base . 'peminjaman')
        ];
        return $data;
    }
}
