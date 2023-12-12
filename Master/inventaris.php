<?php

namespace Master;

use Config\Query_builder;

class inventaris
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('inventaris')->get()->resultArray();
        $res = ' <a href="?target=inventaris&act=tambah_inventaris" class="btn btn-info btn-sm">Tambah inventaris</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kd Inventaris</th>
                    <th>tanggal</th>
                    <th>Nama Inventaris</th>
                    <th>Pemilik</th>
                    <th>keterangan</th>
                    <th>Keterangan</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                        <td width="20">' . $no . '</td>
                        <td width="200">' . $r['kd_inventaris'] . '</td>
                        <td>' . $r['tanggal'] . '</td>
                        <td>' . $r['nama_inventaris'] . '</td>
                        <td>' . $r['pemilik'] . '</td>
                        <td>' . $r['jumlah'] . '</td>
                        <td width="10">' . $r['keterangan'] . '</td>
                        <td width="150">
                            <a href="?target=inventaris&act=edit_inventaris&id=' . $r['kd_inventaris'] . '" class="btn btn-success btn-sm">
                                Edit
                            </a>
                            <a href="?target=inventaris&act=delete_inventaris&id=' . $r['kd_inventaris'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=inventaris" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=inventaris&act=simpan_inventaris" method="post">
                    <div class="mb-3">
                        <label for="kd_inventaris" class="form-label">kd_inventaris</label>
                        <input type="text" class="form-control" id="" name="kd_inventaris">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="nama_inventaris" class="form-label">nama_inventaris</label>
                        <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris">
                    </div>
                    <div class="mb-3">
                        <label for="pemilik" class="form-label">pemilik</label>
                        <input type="text" class="form-control" id="pemilik" name="pemilik">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }
    public function simpan()
    {
        $kd_inventaris = $_POST['kd_inventaris'];
        $tanggal = $_POST['tanggal'];
        $pemilik= $_POST['pemilik'];
        $keterangan= $_POST['keterangan'];
        
        $data = array(
            'kd_inventaris' => $kd_inventaris,
            'tanggal' => $tanggal,
            'pemilik' => $pemilik,
            'keterangan' => $keterangan
            
        );
        return $this->db->table('inventaris')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('inventaris')->where("kd_inventaris='$id'")->get()->rowArray();

        $res = '<a href="?target=inventaris" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=inventaris&act=update_inventaris" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['kd_inventaris'] . '">
                <div class="mb-3">
                        <label for="kd_inventaris" class="form-label">kd_inventaris</label>
                        <input type="text" class="form-control" id="kd_inventaris" name="kd_inventaris" value="' . $r['kd_inventaris'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="' . $r['tanggal'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_inventaris" class="form-label">nama_inventaris</label>
                        <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris" value="' . $r['nama_peminjam'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="pemilik" class="form-label">pemilik</label>
                        <input type="text" class="form-control" id="pemilik" name="pemilik" value="' . $r['pemilik'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="' . $r['jumlah'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="' . $r['keterangan'] . '">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function update()
    {
        $param = $_POST['param'];
        $kd_inventaris = $_POST['kd_inventaris'];
        $tanggal = $_POST['tanggal'];
        $pemilik = $_POST['pemilik'];
        $keterangan = $_POST['keterangan'];
        

        $data = array(
            'kd_inventaris' => $kd_inventaris,
            'tanggal' => $tanggal,
            'pemilik' => $pemilik,
            'keterangan' => $keterangan
        );

        return $this->db->table('inventaris')->where("kd_inventaris='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('inventaris')->where("kd_inventaris='$id'")->delete();
    }
    
}