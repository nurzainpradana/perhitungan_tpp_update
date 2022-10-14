<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserAccess extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') !== TRUE) {
            redirect(base_url() . 'index.php/Login');
        }

        $this->load->model(array(
            "M_pegawai", "M_jabatan",
            "M_capaian_kinerja", "M_user_access"
        ));
    }

    function index()
    {
        $datas['page_title']            = "User Access";

        $this->load->view('layout/v_header', $datas);
        $this->load->view('layout/v_top_menu');
        $this->load->view('layout/v_sidebar');
        $this->load->view('user_access/v_user_access');
        $this->load->view('layout/v_footer');
    }

    function loadCapaianKinerjaListDatatables()
    {

        $jabatan            = $this->M_capaian_kinerja->loadDataCapaianKinerjaDatatables();

        $data               = array();
        $no                 = $_POST['start'];

        $i                  = 0;
        foreach ($jabatan as $item) {
            $no++;
            $row        = array();

            $row[]      = $item->nama;
            $row[]      = $item->nama_jabatan;
            $row[]      = $item->nilai_produktivitas_kerja . " %";
            $row[]      = "
            <button data-id='$item->id_capaian_kinerja' class='btn btn-xs btn-success' onclick='editNilai($item->id_capaian_kinerja)' title='Edit Nilai'><i class='fa fa-edit'></i></button>
            <button data-id='$item->id_capaian_kinerja' class='btn btn-xs btn-danger' onclick='deleteNilai($item->id_capaian_kinerja)' title='Hapus Nilai'><i class='fa fa-trash'></i></button>
            ";

            $data[]     = $row;
            $i++;
        }

        $output         = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->M_jabatan->count_all(),
            "recordsFiltered"   => $this->M_jabatan->count_filtered(),
            "data"              => $data,
        );

        // output to json format

        echo json_encode($output);
    }

    function add()
    {
        $id_pegawai                 = $this->input->post("pegawai");
        $user_id                    = $this->input->post("user_id");
        $password                   = md5($this->input->post("password"));
        $level                      = $this->input->post("level");
        $status                     = $this->input->post("status");

        $check                      = $this->M_user_access->checkUserId($user_id);

        if ($check) {
            $response_status    = "failed";
            $response_message   = "User ID sudah terdaftar";
        } else {
            $data           = array(
                "id_pegawai"                    => $id_pegawai,
                "user_id"                       => $user_id,
                "password"                      => $password,
                "level"                         => $level,
                "status"                        => $status
            );

            $insert         = $this->M_crud->insert("tb_user", $data);

            if ($insert) {
                $response_status        = "success";
                $response_message       = "Berhasil menyimpan data User Access";
            } else {
                $response_status        = "failed";
                $response_message       = "Gagal menyimpan data User Access";
            }
        }



        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function edit()
    {
        $id_capaian_kinerja     = $this->input->post("id_capaian_kinerja");

        $capaian_kinerja        = $this->M_capaian_kinerja->getDetailCapaianKinerja($id_capaian_kinerja);

        if ($capaian_kinerja) {
            $response_data      = $capaian_kinerja;
            $response_status    = "success";
            $response_message   = "Berhasil";
        } else {
            $response_data      = null;
            $response_status    = "failed";
            $response_message   = "Gagal mendapatkan Data Jabatan";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message,
            "data"          => $response_data
        ));
    }

    function Update()
    {
        $presentase_produktivitas   = $this->input->post("presentase_produktivitas");
        $pegawai                    = $this->input->post("id_pegawai");
        $periode                    = $this->input->post("periode");

        $data       = array(
            "nilai_produktivitas_kerja"      => $presentase_produktivitas
        );

        $where      = array(
            "id_pegawai"        => $pegawai,
            "periode"           => $periode,
            "id_approval"       => null
        );

        $update             = $this->M_crud->update("tb_capaian_kerja", $data, $where);

        if ($update) {
            $response_status        = "success";
            $response_message       = "Berhasil mengedit Presentase Produktivitas Kinerja";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal mengedit Presentase Produktivitas Kinerja";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function delete()
    {
        $id_capaian_kinerja         = $this->input->post("id_capaian_kinerja");

        $where             = array(
            "id_capaian_kinerja"            => $id_capaian_kinerja
        );

        $delete     = $this->M_crud->delete("tb_capaian_kerja", $where);

        if ($delete) {
            $response_status        = "success";
            $response_message       = "Berhasil menghapus Nilai Capaian Kinerja";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal menghapus Nilai Capaian Kinerja";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }
}
