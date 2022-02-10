<?php
class M_Perusahaan extends CI_Model
{
    function tampil_perusahaan()
    {
        return $this->db->query("SELECT * FROM perusahaan");
    }

    function informasi_perusahaan($username)
    {
        return $this->db->query("SELECT * FROM perusahaan JOIN subscribe ON perusahaan.id_perusahaan = subscribe.id_perusahaan 
                                JOIN paket ON subscribe.id_paket = paket.id_paket WHERE username = '$username'");
    }

    function pilih_perusahaan($id_perusahaan)
    {
        return $this->db->query("SELECT * FROM perusahaan WHERE id_perusahaan = '$id_perusahaan'");
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function cek_status($username)
    {
        return $this->db->query("SELECT username FROM perusahaan  WHERE username = '$username' AND status_perusahaan = '1'");
    }

    function lihat_karyawan($id_perusahaan)
    {
        return $this->db->query("SELECT perusahaan.id_perusahaan, id_karyawan, nama_karyawan, alamat_karyawan, email_karyawan, posisi_karyawan, status_karyawan, foto_karyawan from karyawan 
                                JOIN perusahaan ON karyawan.id_perusahaan = perusahaan.id_perusahaan WHERE perusahaan.id_perusahaan = '$id_perusahaan'");
    }

    function insert_record($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function update_record($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
