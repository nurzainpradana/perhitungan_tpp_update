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
        $tidak_hadir_apel           = $this->input->post("tidak_hadir_apel");
        $tidak_hadir_rapat          = $this->input->post("tidak_hadir_rapat");
        $pengurangan_tpp            = $this->input->post("pengurangan_tpp");
        $penambahan_tpp             = $this->input->post("penambahan_tpp");

        $nilai_tidak_hadir      = 0;
        if ($tidak_hadir <= 22) {
            $nilai_tidak_hadir      = $tidak_hadir * 3;
        } else if ($tidak_hadir > 22) {
            $nilai_tidak_hadir      = 100;
        }

        $nilai_dl_pc    = 0;

        switch ($dl_pc) {
            case $dl_pc <= 0:
                $nilai_dl_pc    = 0;
                break;

            case $dl_pc >= 0 && $dl_pc < 450:
                $nilai_dl_pc    = 0;
                break;

            case $dl_pc >= 450 && $dl_pc < 900:
                $nilai_dl_pc    = 3;
                break;

            case $dl_pc  >= 900 && $dl_pc < 1350:
                $nilai_dl_pc    = 6;
                break;

            case $dl_pc >= 1350 && $dl_pc < 1800:
                $nilai_dl_pc    = 9;
                break;

            case $dl_pc >= 1800 && $dl_pc < 2250:
                $nilai_dl_pc    = 12;
                break;

            case $dl_pc >= 2250 && $dl_pc < 2700:
                $nilai_dl_pc    = 15;
                break;

            case $dl_pc >= 2700 && $dl_pc < 3150:
                $nilai_dl_pc    = 18;
                break;

            case $dl_pc >= 3150 && $dl_pc < 3600:
                $nilai_dl_pc    = 21;
                break;

            case $dl_pc >= 3600 && $dl_pc < 4050:
                $nilai_dl_pc    = 24;
                break;

            case $dl_pc >= 4050 && $dl_pc < 4500:
                $nilai_dl_pc    = 27;
                break;

            case $dl_pc >= 4500 && $dl_pc < 4950:
                $nilai_dl_pc    = 30;
                break;

            case $dl_pc >= 4950 && $dl_pc < 5400:
                $nilai_dl_pc    = 33;
                break;

            case $dl_pc >= 5400 && $dl_pc < 5850:
                $nilai_dl_pc    = 36;
                break;

            case $dl_pc >= 5850 && $dl_pc < 6300:
                $nilai_dl_pc    = 39;
                break;

            case $dl_pc >= 6300 && $dl_pc < 6750:
                $nilai_dl_pc    = 42;
                break;

            case $dl_pc >= 6750 && $dl_pc < 7200:
                $nilai_dl_pc    = 45;
                break;

            case $dl_pc >= 7200 && $dl_pc < 7650:
                $nilai_dl_pc    = 48;
                break;

            case $dl_pc >= 7650 && $dl_pc < 8100:
                $nilai_dl_pc    = 51;
                break;

            case $dl_pc >= 8100 && $dl_pc < 8550:
                $nilai_dl_pc    = 54;
                break;

            case $dl_pc >= 8550 && $dl_pc < 9000:
                $nilai_dl_pc    = 57;
                break;

            default:
                $nilai_dl_pc   = 57;
                break;
        }

        $nilai_tidak_hadir_apel             = $tidak_hadir_apel * 0.2;
        $nilai_tidak_hadir_rapat            = $tidak_hadir_rapat;
        $total_pengurangan_tpp_dis_kerja    = $nilai_tidak_hadir + $nilai_dl_pc + $nilai_tidak_hadir_apel + $nilai_tidak_hadir_rapat;
        $presentase_disiplin_kerja          = (100 - $total_pengurangan_tpp_dis_kerja) / 100;

        $data           = array(
            "id_pegawai"                    => $id_pegawai,
            "periode"                       => $periode,
            "jumlah_hari_kerja"             => $jumlah_hari_kerja,
            "jumlah_tidak_hadir"            => $tidak_hadir,
            "jumlah_dl_pc"                  => $dl_pc,
            "jumlah_tidak_hadir_rapat"      => $tidak_hadir_rapat,
            "jumlah_tidak_hadir_apel"       => $tidak_hadir_apel,

            "nilai_tidak_hadir"             => $nilai_tidak_hadir,
            "nilai_dl_pc"                   => $nilai_dl_pc,
            "nilai_tidak_hadir_rapat"       => $nilai_tidak_hadir_rapat,
            "nilai_tidak_hadir_apel"        => $nilai_tidak_hadir_apel,

            "total_pengurangan_tpp"         => $pengurangan_tpp,
            "total_penambahan_tpp"          => $penambahan_tpp,
            "nilai_disiplin_kerja"          => $presentase_disiplin_kerja,

            "total_pengurang_tpp_disiplin_kerja"    => $total_pengurangan_tpp_dis_kerja
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
        $id_pegawai                 = $this->input->post("pegawai");
        $periode                    = $this->input->post("periode");

        $jumlah_hari_kerja          = $this->input->post("jumlah_hari_kerja");
        $tidak_hadir                = $this->input->post("tidak_hadir");
        $dl_pc                      = $this->input->post("dl_pc");
        $tidak_hadir_apel           = $this->input->post("tidak_hadir_apel");
        $tidak_hadir_rapat          = $this->input->post("tidak_hadir_rapat");
        $pengurangan_tpp            = $this->input->post("pengurangan_tpp");
        $penambahan_tpp             = $this->input->post("penambahan_tpp");

        $nilai_tidak_hadir      = 0;
        if ($tidak_hadir <= 22) {
            $nilai_tidak_hadir      = $tidak_hadir * 3;
        } else if ($tidak_hadir > 22) {
            $nilai_tidak_hadir      = 100;
        }

        $nilai_dl_pc    = 0;

        switch ($dl_pc) {
            case $dl_pc <= 0:
                $nilai_dl_pc    = 0;
                break;

            case $dl_pc >= 0 && $dl_pc < 450:
                $nilai_dl_pc    = 0;
                break;

            case $dl_pc >= 450 && $dl_pc < 900:
                $nilai_dl_pc    = 3;
                break;

            case $dl_pc  >= 900 && $dl_pc < 1350:
                $nilai_dl_pc    = 6;
                break;

            case $dl_pc >= 1350 && $dl_pc < 1800:
                $nilai_dl_pc    = 9;
                break;

            case $dl_pc >= 1800 && $dl_pc < 2250:
                $nilai_dl_pc    = 12;
                break;

            case $dl_pc >= 2250 && $dl_pc < 2700:
                $nilai_dl_pc    = 15;
                break;

            case $dl_pc >= 2700 && $dl_pc < 3150:
                $nilai_dl_pc    = 18;
                break;

            case $dl_pc >= 3150 && $dl_pc < 3600:
                $nilai_dl_pc    = 21;
                break;

            case $dl_pc >= 3600 && $dl_pc < 4050:
                $nilai_dl_pc    = 24;
                break;

            case $dl_pc >= 4050 && $dl_pc < 4500:
                $nilai_dl_pc    = 27;
                break;

            case $dl_pc >= 4500 && $dl_pc < 4950:
                $nilai_dl_pc    = 30;
                break;

            case $dl_pc >= 4950 && $dl_pc < 5400:
                $nilai_dl_pc    = 33;
                break;

            case $dl_pc >= 5400 && $dl_pc < 5850:
                $nilai_dl_pc    = 36;
                break;

            case $dl_pc >= 5850 && $dl_pc < 6300:
                $nilai_dl_pc    = 39;
                break;

            case $dl_pc >= 6300 && $dl_pc < 6750:
                $nilai_dl_pc    = 42;
                break;

            case $dl_pc >= 6750 && $dl_pc < 7200:
                $nilai_dl_pc    = 45;
                break;

            case $dl_pc >= 7200 && $dl_pc < 7650:
                $nilai_dl_pc    = 48;
                break;

            case $dl_pc >= 7650 && $dl_pc < 8100:
                $nilai_dl_pc    = 51;
                break;

            case $dl_pc >= 8100 && $dl_pc < 8550:
                $nilai_dl_pc    = 54;
                break;

            case $dl_pc >= 8550 && $dl_pc < 9000:
                $nilai_dl_pc    = 57;
                break;

            default:
                $nilai_dl_pc   = 57;
                break;
        }

        $nilai_tidak_hadir_apel             = $tidak_hadir_apel * 0.2;
        $nilai_tidak_hadir_rapat            = $tidak_hadir_rapat;
        $total_pengurangan_tpp_dis_kerja    = $nilai_tidak_hadir + $nilai_dl_pc + $nilai_tidak_hadir_apel + $nilai_tidak_hadir_rapat;
        $presentase_disiplin_kerja          = (100 - $total_pengurangan_tpp_dis_kerja);

        $data           = array(
            "jumlah_hari_kerja"             => $jumlah_hari_kerja,
            "jumlah_tidak_hadir"            => $tidak_hadir,
            "jumlah_dl_pc"                  => $dl_pc,
            "jumlah_tidak_hadir_rapat"      => $tidak_hadir_rapat,
            "jumlah_tidak_hadir_apel"       => $tidak_hadir_apel,

            "nilai_tidak_hadir"             => $nilai_tidak_hadir,
            "nilai_dl_pc"                   => $nilai_dl_pc,
            "nilai_tidak_hadir_rapat"       => $nilai_tidak_hadir_rapat,
            "nilai_tidak_hadir_apel"        => $nilai_tidak_hadir_apel,

            "total_pengurangan_tpp"         => $pengurangan_tpp,
            "total_penambahan_tpp"          => $penambahan_tpp,
            "nilai_disiplin_kerja"          => $presentase_disiplin_kerja,

            "total_pengurang_tpp_disiplin_kerja"    => $total_pengurangan_tpp_dis_kerja
        );

        $where      = array(
            "id_pegawai"                    => $id_pegawai,
            "periode"                       => $periode
        );

        $update         = $this->M_crud->update("tb_rekapitulasi_presensi", $data, $where);

        if ($update) {
            $response_status        = "success";
            $response_message       = "Berhasil Mengupdate data Rekapitulasi Presensi pegawai";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal Mengupdate data Rekapitulasi Presensi pegawai";
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


    /**
     * REPORT
     * ===============================
     */

    function laporan()
    {
        $datas['page_title']            = "Laporan Rekapitulasi Presensi";

        $this->load->view('layout/v_header', $datas);
        $this->load->view('layout/v_top_menu');
        $this->load->view('layout/v_sidebar');
        $this->load->view('rekapitulasi_presensi/v_laporan_rekapitulasi_presensi');
        $this->load->view('layout/v_footer');
    }
}
