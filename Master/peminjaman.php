<?php

namespace Master;

use Config\Query_builder;

class peminjaman
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('peminjaman')->get()->resultArray();
        $res = ' <a href="?target=peminjaman&act=tambah_peminjaman" class="btn btn-info btn-sm">Tambah peminjaman</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                        <td width="20">' . $no . '</td>
                        <td width="200">' . $r['tanggal'] . '</td>
                        <td>' . $r['nama_peminjam'] . '</td>
                        <td>' . $r['nama_barang'] . '</td>
                        <td width="10">' . $r['jumlah'] . '</td>
                        <td width="150">
                            <a href="?target=peminjaman&act=edit_peminjaman&id=' . $r['tanggal'] . '" class="btn btn-success btn-sm">
                                Edit
                            </a>
                            <a href="?target=peminjaman&act=delete_peminjaman&id=' . $r['tanggal'] . '" class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>';
                $no++;
            }
            $res .= '</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=peminjaman" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=peminjaman&act=simpan_peminjaman" method="post">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">nama_peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam">
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }
    public function simpan()
    {
        $tanggal = $_POST['tanggal'];
        $nama_peminjam = $_POST['nama_peminjam'];
        $nama_barang= $_POST['nama_barang'];
        $jumlah= $_POST['jumlah'];
        
        $data = array(
            'tanggal' => $tanggal,
            'nama_peminjam' => $nama_peminjam,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah
            
        );
        return $this->db->table('peminjaman')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('peminjaman')->where("tanggal='$id'")->get()->rowArray();

        $res = '<a href="?target=peminjaman" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=peminjaman&act=update_peminjaman" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['tanggal'] . '">
                <div class="mb-3">
                        <label for="tanggal" class="form-label">tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="' . $r['tanggal'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">nama_peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="' . $r['nama_peminjam'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">nama_barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="' . $r['nama_barang'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="' . $r['jumlah'] . '">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function update()
    {
        $param = $_POST['param'];
        $tanggal = $_POST['tanggal'];
        $nama_peminjam = $_POST['nama_peminjam'];
        $nama_barang = $_POST['nama_barang'];
        $jumlah = $_POST['jumlah'];
        

        $data = array(
            'tanggal' => $tanggal,
            'nama_peminjam' => $nama_peminjam,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah
        );

        return $this->db->table('peminjaman')->where("tanggal='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('peminjaman')->where("tanggal='$id'")->delete();
    }
    
}