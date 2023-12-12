<?php

namespace Master;

use Config\Query_builder;

class Admin
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('admin')->get()->resultArray();
        $res = ' <a href="?target=admin&act=tambah_admin" class="btn btn-info btn-sm">Tambah admin</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id Admin</th>
                    <th>Nama Admin</th>
                    <th>Status</th>
                    <th>jk</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                        <td width="20">' . $no . '</td>
                        <td width="200">' . $r['id_admin'] . '</td>
                        <td>' . $r['nama_admin'] . '</td>
                        <td>' . $r['status'] . '</td>
                        <td width="10">' . $r['jk'] . '</td>
                        <td width="150">
                            <a href="?target=admin&act=edit_admin&id=' . $r['id_admin'] . '" class="btn btn-success btn-sm">
                                Edit
                            </a>
                            <a href="?target=admin&act=delete_admin&id=' . $r['id_admin'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=simpan_admin" method="post">
                    <div class="mb-3">
                        <label for="id_admin" class="form-label">id_admin</label>
                        <input type="text" class="form-control" id="" name="id_admin">
                    </div>
                    <div class="mb-3">
                        <label for="nama_admin" class="form-label">nama_admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" class="form-control" id="status" name="status">
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">jk</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk1" value="1">
                            <label for="jk1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk0" value="0">
                            <label for="jk0" class="form-check-label">
                                P
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }
    public function simpan()
    {
        $id_admin = $_POST['id_admin'];
        $nama_admin = $_POST['nama_admin'];
        $status= $_POST['status'];
        $jk= $_POST['jk'];
        
        $data = array(
            'id_admin' => $id_admin,
            'nama_admin' => $nama_admin,
            'status' => $status,
            'jk' => $jk
            
        );
        return $this->db->table('admin')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('admin')->where("id_admin='$id'")->get()->rowArray();

        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=uptext_admin" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_admin'] . '">
                <div class="mb-3">
                        <label for="id_admin" class="form-label">id_admin</label>
                        <input type="text" class="form-control" id="id_admin" name="id_admin" value="' . $r['id_admin'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="nama_admin" class="form-label">nama_admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="' . $r['nama_admin'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" class="form-control" id="status" name="status" value="' . $r['status'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">jk</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk1" value="1">
                            <label for="jk1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk0" value="0">
                            <label for="jk0" class="form-check-label">
                                P
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function uptext()
    {
        $param = $_POST['param'];
        $id_admin = $_POST['id_admin'];
        $nama_admin = $_POST['nama_admin'];
        $status = $_POST['status'];
        $jk = $_POST['jk'];
        

        $data = array(
            'id_admin' => $id_admin,
            'nama_admin' => $nama_admin,
            'status' => $status,
            'jk' => $jk
        );

        return $this->db->table('admin')->where("id_admin='$param'")->uptext($data);
    }

    public function delete($id)
    {

        return $this->db->table('admin')->where("id_admin='$id'")->delete();
    }
    
}