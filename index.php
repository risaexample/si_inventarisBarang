<?php

use Master\peminjaman;
use Master\admin;
use Master\Menu;
use Master\inventaris;

include('autoload.php');
include('Config/Database.php');

$menu = new Menu();
$peminjaman = new peminjaman($dataKoneksi);
$admin = new admin($dataKoneksi);
$inventaris = new inventaris($dataKoneksi);
//$peminjaman ->tambah()
//$admin ->tambah()
$target = @$_GET['target'];
$act = @$_GET['act']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">INVENTARIS</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($menu->topMenu() as $r) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['link']; ?>" class="nav-link">
                                    <?php echo $r['text']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>

            <?php
            if (!isset($target) or $target == "beranda") {
                echo "Hai, Selamat Datang di Beranda Inventaris";
                //====start content peminjaman====
            } elseif ($target == "peminjaman") {
                if ($act == "tambah_peminjaman") {
                    echo $peminjaman->tambah();
                } elseif ($act == "simpan_peminjaman") {
                    if ($peminjaman->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    }
                } elseif ($act == "edit_peminjaman") {
                    $id = $_GET['id'];
                    echo $peminjaman->edit($id);
                } elseif ($act == "update_peminjaman") {
                    if ($peminjaman->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    }
                } elseif ($act == "delete_peminjaman") {
                    $id = $_GET['id'];
                    if ($peminjaman->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=peminjaman'
                        </script>";
                    }
                } else {
                    echo $peminjaman->index();
                }
                //====start content admin====
            } elseif ($target == "admin") {
                if ($act == "tambah_admin") {
                    echo $admin->tambah();
                } elseif ($act == "simpan_admin") {
                    if ($admin->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } elseif ($act == "edit_admin") {
                    $id = $_GET['id'];
                    echo $admin->edit($id);
                } elseif ($act == "update_admin") {
                    if ($admin->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } elseif ($act == "delete_admin") {
                    $id = $_GET['id'];
                    if ($admin->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } else {
                    echo $admin->index();
                }
               
                //====And Content inventaris====
           
            } elseif ($target == "inventaris") {
                if ($act == "tambah_inventaris") {
                    echo $inventaris->tambah();
                } elseif ($act == "simpan_inventaris") {
                    if ($inventaris->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=inventaris'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=inventaris'
                        </script>";
                    }
                } elseif ($act == "edit_inventaris") {
                    $id = $_GET['id'];
                    echo $inventaris->edit($id);
                } elseif ($act == "update_inventaris") {
                    if ($inventaris->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=inventaris'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=inventaris'
                        </script>";
                    }
                } elseif ($act == "delete_inventaris") {
                    $id = $_GET['id'];
                    if ($inventaris->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=inventaris'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=inventaris'
                        </script>";
                    }
                } else {
                    echo $inventaris->index();
                }
               
                
            }
            ?>
        </div>
    </div>
</body>

</html>