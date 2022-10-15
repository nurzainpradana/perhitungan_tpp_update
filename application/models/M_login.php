<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class M_login extends CI_Model
{
    function checkUserId($user_id, $pass)
    {
        $this->db->select("u.*, p.nama, j.nama_jabatan, p.nip_pegawai, id_jabatangit s");
        $this->db->from("tb_user u");
        $this->db->join("tb_pegawai p", "u.id_pegawai = p.id_pegawai");
        $this->db->join("tb_jabatan j", "p.id_jabatan = j.id_jabatan");
        $this->db->where("u.user_id", $user_id);
        $this->db->where("u.password", md5($pass));

        return $this->db->get()->row();
    }
}
