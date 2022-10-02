<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapitulasiPresensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') !== TRUE) {
            redirect(base_url() . 'index.php/Login');
        }

        $this->load->model(array(
            "M_pegawai", "M_jabatan",
            "M_capaian_kinerja",
            "M_rekapitulasi_presensi"
        ));
    }

    function index()
    {
        $datas['page_title']            = "Rekapitulasi Presensi";

        $this->load->view('layout/v_header', $datas);
        $this->load->view('layout/v_top_menu');
        $this->load->view('layout/v_sidebar');
        $this->load->view('rekapitulasi_presensi/v_rekapitulasi_presensi');
        $this->load->view('layout/v_footer');
    }

    function loadRekapitulasiPresensiListDatatables()
    {

        $rekapitulasi_presensi            = $this->M_rekapitulasi_presensi->loadDataRekapitulasiPresensiDatatables();

        $data               = array();
        $no                 = $_POST['start'];

        $i                  = 0;
        foreach ($rekapitulasi_presensi as $item) {
            $no++;
            $row        = array();

            $row[]      = $item->nama;
            $row[]      = $item->nama_jabatan;
            $row[]      = $item->jumlah_hari_kerja != null ? $item->jumlah_hari_kerja . " Hari" : "-";
            $row[]      = $item->jumlah_tidak_hadir != null ? $item->jumlah_tidak_hadir . " Hari" : "-";
            $row[]      = $item->jumlah_dl_pc != null ? $item->jumlah_dl_pc . " Menit" : "-";
            $row[]      = $item->jumlah_tidak_hadir_rapat != null ? $item->jumlah_tidak_hadir_rapat . " Hari" : "-";

            if ($item->total_pengurangan_tpp > 0) {
                $total_pengurangan_tpp = "Rp " . number_format($item->total_pengurangan_tpp, 2, ',', '.');
            } else {
                $total_pengurangan_tpp  = $item->total_pengurangan_tpp;
            }



            $row[]      = $total_pengurangan_tpp;
            $row[]      = $item->nilai_disiplin_kerja . " %";
            $row[]      = "
            <button data-id='$item->id_rekapitulasi_presensi' class='btn btn-xs btn-success' onclick='editNilai($item->id_rekapitulasi_presensi)' title='Edit Nilai'><i class='fa fa-edit'></i></button>
            <button data-id='$item->id_rekapitulasi_presensi' class='btn btn-xs btn-danger' onclick='deleteNilai($item->id_rekapitulasi_presensi)' title='Hapus Nilai'><i class='fa fa-trash'></i></button>
            ";

            $data[]     = $row;
            $i++;
        }

        $output         = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->M_rekapitulasi_presensi->count_all(),
            "recordsFiltered"   => $this->M_rekapitulasi_presensi->count_filtered(),
            "data"              => $data,
        );

        // output to json format

        echo json_encode($output);
    }

    function add()
    {
        $id_pegawai                 = $this->input->post("pegawai");
        $periode                    = $this->input->post("periode");

        $jumlah_hari_kerja          = $this->input->post("jumlah_hari_kerja");
        $tidak_hadir                = $this->input->post("tidak_hadir");
        $dl_pc                      = $this->input->post("dl_pc");
        $tidak_hadir_rapat          = $this->input->post("tidak_hadir_rapat");
        $pengurangan_tpp            = $this->input->post("pengurangan_tpp");
        $presentase_disiplin_kerja  = $this->input->post("presentase_disiplin_kerja");


        $data           = array(
            "id_pegawai"                    => $id_pegawai,
            "periode"                       => $periode,
            "jumlah_hari_kerja"             => $jumlah_hari_kerja,
            "jumlah_tidak_hadir"            => $tidak_hadir,
            "jumlah_dl_pc"                  => $dl_pc,
            "jumlah_tidak_hadir_rapat"      => $tidak_hadir_rapat,
            "total_pengurangan_tpp"         => $pengurangan_tpp,
            "nilai_disiplin_kerja"          => $presentase_disiplin_kerja
        );

        $insert         = $this->M_crud->insert("tb_rekapitulasi_presensi", $data);

        if ($insert) {
            $response_status        = "success";
            $response_message       = "Berhasil menyimpan data Rekapitulasi Presensi pegawai";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal menyimpan data Rekapitulasi Presensi pegawai";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function edit()
    {
        $id_rekapitulasi_presensi     = $this->input->post("id_rekapitulasi_presensi");

        $rekapitulasi_presensi        = $this->M_rekapitulasi_presensi->getDetailRekapitulasiPresensiPegawai($id_rekapitulasi_presensi);

        if ($rekapitulasi_presensi) {
            $response_data      = $rekapitulasi_presensi;
            $response_status    = "success";
            $response_message   = "Berhasil";
        } else {
            $response_data      = null;
            $response_status    = "failed";
            $response_message   = "Gagal mendapatkan Data Rekapitulasi Presensi";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message,
            "data"          => $response_data
        ));
    }

    function Update()
    {
        $pegawai                    = $this->input->post("pegawai");
        $periode                    = $this->input->post("periode");

        $jumlah_hari_kerja          = $this->input->post("jumlah_hari_kerja");
        $jumlah_tidak_hadir         = $this->input->post("tidak_hadir");
        $jumlah_dl_pc               = $this->input->post("dl_pc");
        $jumlah_tidak_hadir_rapat   = $this->input->post("tidak_hadir_rapat");
        $pengurangan_tpp            = $this->input->post("pengurangan_tpp");
        $presentase_disiplin_kerja  = $this->input->post("presentase_disiplin_kerja");


        $data       = array(
            "jumlah_hari_kerja"         => $jumlah_hari_kerja,
            "jumlah_tidak_hadir"        => $jumlah_tidak_hadir,
            "jumlah_dl_pc"              => $jumlah_dl_pc,
            "jumlah_tidak_hadir_rapat"  => $jumlah_tidak_hadir_rapat,
            "total_pengurangan_tpp"     => $pengurangan_tpp,
            "nilai_disiplin_kerja"      => $presentase_disiplin_kerja
        );

        $where      = array(
            "id_pegawai"        => $pegawai,
            "periode"           => $periode,
            "id_approval"       => null
        );

        $update             = $this->M_crud->update("tb_rekapitulasi_presensi", $data, $where);

        if ($update) {
            $response_status        = "success";
            $response_message       = "Berhasil mengedit Rekapitulasi Presensi Pegawai";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal mengedit Rekapitulasi Presensi Pegawai";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function delete()
    {
        $id_rekapitulasi_presensi         = $this->input->post("id_rekapitulasi_presensi");

        $where             = array(
            "id_rekapitulasi_presensi"  => $id_rekapitulasi_presensi,
            "id_approval"               => null
        );

        $delete     = $this->M_crud->delete("tb_rekapitulasi_presensi", $where);

        if ($delete) {
            $response_status        = "success";
            $response_message       = "Berhasil menghapus Rekapitulasi Presensi";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal menghapus Rekapitulasi Presensi";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }
}
