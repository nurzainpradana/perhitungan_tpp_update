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

    function loadUserAccessListDatatables()
    {

        $jabatan            = $this->M_user_access->loadDataUserAccessDatatables();

        $data               = array();
        $no                 = $_POST['start'];

        $i                  = 0;
        foreach ($jabatan as $item) {
            $no++;
            $row        = array();

            $row[]      = $item->nama;
            $row[]      = $item->user_id;

            $level      = "";

            switch($item->level)
            {
                case 1 : 
                    $level  = "Admin Umpeg";
                    break;

                case 2 :
                    $level  = "Admin Keuangan";
                    break;
                
                case 3 :
                    $level  = "Kasubag Umpeg";
                    break;

                case 4 :
                    $level  = "Camat";
                    break;

            }
            $row[]      = $level;
            $row[]      = "
            <button data-id='$item->id_user_access' class='btn btn-xs btn-success' onclick='edit($item->id_user_access)' title='Edit User'><i class='fa fa-edit'></i></button>
            <button data-id='$item->id_user_access' class='btn btn-xs btn-danger' onclick='delete($item->id_user_access)' title='Hapus User'><i class='fa fa-trash'></i></button>
            ";

            $data[]     = $row;
            $i++;
        }

        $output         = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->M_user_access->count_all(),
            "recordsFiltered"   => $this->M_user_access->count_filtered(),
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
        $level                      = $this->input->post("level_user");
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
        $id_user_access     = $this->input->post("id_user_access");

        $user_acces        = $this->M_user_access->getDetailUserAccess($id_user_access);

        if ($user_acces) {
            $response_data      = $user_acces;
            $response_status    = "success";
            $response_message   = "Berhasil";
        } else {
            $response_data      = null;
            $response_status    = "failed";
            $response_message   = "Gagal mendapatkan Data User Access";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message,
            "data"          => $response_data
        ));
    }

    function Update()
    {
        $id_pegawai                 = $this->input->post("pegawai");
        $user_id                    = $this->input->post("user_id");
        $password                   = md5($this->input->post("password"));
        $level                      = $this->input->post("level_user");
        $status                     = $this->input->post("status");
        $id_user_access             = $this->input->post("id_user_access");

        $user_access                = $this->input->post("id_user_access");

        $data           = array(
            "id_pegawai"                    => $id_pegawai,
            "user_id"                       => $user_id,
            "level"                         => $level,
            "status"                        => $status
        );

        if($this->input->post("password"))
        {
            $data["password"]           = $password;
        }

        $where      = array(
            "id_user_access"        => $id_user_access
        );

        $update         = $this->M_crud->update("tb_user", $data, $where);

        if($update)
        {
            
        }

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
