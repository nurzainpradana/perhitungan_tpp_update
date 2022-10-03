<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TPP extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') !== TRUE) {
            redirect(base_url() . 'index.php/Login');
        }

        $this->load->model(array(
            "M_jabatan",
            "M_tpp"
        ));
    }

    function index()
    {
        $datas['page_title']            = "TPP";

        $this->load->view('layout/v_header', $datas);
        $this->load->view('layout/v_top_menu');
        $this->load->view('layout/v_sidebar');
        $this->load->view('tpp/v_tpp');
        $this->load->view('layout/v_footer');
    }

    function detailTPP($periode)
    {
        $datas['page_title']            = "TPP PERIODE $periode";

        $data['periode']                = strtoupper($this->tgl_indo($periode));
        $data['periode_ori']            = $periode;

        $result                         = $this->M_tpp->loadTppByPeriode($periode);

        $data['result']                 = $result;

        $this->load->view('layout/v_header', $datas);
        $this->load->view('layout/v_top_menu');
        $this->load->view('layout/v_sidebar');
        $this->load->view('tpp/v_tpp_detail', $data);
        $this->load->view('layout/v_footer');
    }

    function cetakTPP()
    {
        $periode        = $this->input->post("periode");

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("IT DEV ZIPCO");
        $objPHPExcel->getProperties()->setLastModifiedBy("IT DEV ZIPCO");
        $objPHPExcel->getProperties()->setTitle("VOUCHER HISTORY LIST");
        // $objPHPExcel->getProperties()->setSubject("Content Subject");
        // $objPHPExcel->getProperties()->setDescription("Content Description");

        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('VOUCHER HISTORY LIST');

        //Setting Width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'VOUCHER HISTORY LIST');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'ACCOUNTING STORAGE SYSTEM');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Export Date ' . date("Y-m-d H:i:s"));

        //Header
        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 'DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('C5', 'EMPLOYEE NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TYPE');
        $objPHPExcel->getActiveSheet()->setCellValue('E5', 'VOUCHER NO');
        $objPHPExcel->getActiveSheet()->setCellValue('F5', 'PAYMENT TO');
        $objPHPExcel->getActiveSheet()->setCellValue('G5', 'PARTICULARS');
        $objPHPExcel->getActiveSheet()->setCellValue('H5', 'BANK NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('I5', 'CURRENCY');
        $objPHPExcel->getActiveSheet()->setCellValue('J5', 'LOCATION');

        $row        = 6;
        $no         = 1;

        $data       = $this->M_voucher_history->loadVoucherHistoryList();

        if ($data) {
            foreach ($data as $i) {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $i->date);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $i->employee_name);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $i->type);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $i->VoucherNo);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $i->PaymentTo);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $i->Particulars);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $i->BankName);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $i->Currency);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $i->location_name);
                $row++;
                $no++;
            }
        }

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $style_color = array(
            'color' => array(
                'rgb' => 'FF0000'
            )
        );

        $row    = $row - 1;

        //Setting CELL
        $objPHPExcel->getActiveSheet()->getStyle('A5:J' . $row)->applyFromArray($styleArray);
        unset($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A5:J5')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => '68a7d9')));
        $objPHPExcel->getActiveSheet()->getStyle('A1:J5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A5:J' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5:J' . $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F5:G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(false);


        $filename = 'VOUCHER_HISTORY_' . time() . '.xls'; //save our workbook as this file name


        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');

        exit;
    }

    function ProsesHitungTPP()
    {
        $periode        = $this->input->post("periode");

        // List Data Pegawai yang datanya sudah lengkap 
        $loadListTPPBelumProses     = $this->M_tpp->loadListTPPBelumProses($periode);

        if ($loadListTPPBelumProses) {
            $result          = [];
            foreach ($loadListTPPBelumProses as $item) {
                $id_pegawai     = $item->id_pegawai;

                $check          = $this->M_tpp->checkTPPPegawaiPeriode($id_pegawai, $periode);

                $tpp_beban_kerja        = $item->beban_kerja;
                $tpp_prestasi_kerja     = $item->prestasi_kerja;
                $tpp_kondisi_kerja      = $item->kondisi_kerja;
                $tpp_kelangkaan_profesi = $item->kelangkaan_profesi;

                $nilai_disiplin_kerja   = $item->nilai_disiplin_kerja;
                $nilai_produktivitas_kerja  = $item->nilai_produktivitas_kerja;

                $presentase_tpp_disiplin_kerja  = 0.4;
                $presentase_tpp_produktivitas_kerja = 0.6;

                $total_tpp              = $tpp_beban_kerja + $tpp_prestasi_kerja + $tpp_kondisi_kerja + $tpp_kelangkaan_profesi;

                // HITUNG DISIPLIN KERJA

                $dis_kerja_beban_kerja          = $presentase_tpp_disiplin_kerja * ($nilai_disiplin_kerja / 100) * $tpp_beban_kerja;
                $dis_kerja_prestasi_kerja       = $presentase_tpp_disiplin_kerja * ($nilai_disiplin_kerja / 100) * $tpp_prestasi_kerja;
                $dis_kerja_kondisi_kerja        = $presentase_tpp_disiplin_kerja * ($nilai_disiplin_kerja / 100) * $tpp_kondisi_kerja;
                $dis_kerja_kelangkaan_profesi   = $presentase_tpp_disiplin_kerja * ($nilai_disiplin_kerja / 100) * $tpp_kelangkaan_profesi;

                $dis_kerja_diterima                = $dis_kerja_beban_kerja + $dis_kerja_prestasi_kerja + $dis_kerja_kondisi_kerja + $dis_kerja_kelangkaan_profesi;

                // HITUNG PRODUKTIVITAS KERJA

                $prod_kerja_beban_kerja          = $presentase_tpp_produktivitas_kerja * ($nilai_produktivitas_kerja / 100) * $tpp_beban_kerja;
                $prod_kerja_prestasi_kerja       = $presentase_tpp_produktivitas_kerja * ($nilai_produktivitas_kerja / 100) * $tpp_prestasi_kerja;
                $prod_kerja_kondisi_kerja        = $presentase_tpp_produktivitas_kerja * ($nilai_produktivitas_kerja / 100) * $tpp_kondisi_kerja;
                $prod_kerja_kelangkaan_profesi   = $presentase_tpp_produktivitas_kerja * ($nilai_produktivitas_kerja / 100) * $tpp_kelangkaan_profesi;

                $prod_kerja_diterima             = $prod_kerja_beban_kerja + $prod_kerja_prestasi_kerja + $prod_kerja_kondisi_kerja + $prod_kerja_kelangkaan_profesi;

                $tambahan_tpp                   = $item->tambahan_tpp;
                $pengurang_tpp                  = $item->total_pengurangan_tpp;

                $grand_total                    = $total_tpp + $dis_kerja_diterima + $prod_kerja_diterima + $tambahan_tpp + $pengurang_tpp;

                $row       = array(
                    "tpp_beban_kerja"           => $tpp_beban_kerja,
                    "tpp_prestasi_kerja"        => $tpp_prestasi_kerja,
                    "tpp_kondisi_kerja"         => $tpp_kondisi_kerja,
                    "tpp_kelangkaan_profesi"    => $tpp_kelangkaan_profesi,
                    "total_tpp"                 => $total_tpp,
                    "nilai_disiplin_kerja"      => $nilai_disiplin_kerja,
                    "nilai_produktivitas_kerja" => $nilai_produktivitas_kerja,

                    "dis_kerja_beban_kerja"     => $dis_kerja_beban_kerja,
                    "dis_kerja_prestasi_kerja"  => $dis_kerja_prestasi_kerja,
                    "dis_kerja_kondisi_kerja"   => $dis_kerja_kondisi_kerja,
                    "dis_kerja_kelangkaan_profesi"  => $dis_kerja_kelangkaan_profesi,
                    "dis_kerja_diterima"            => $dis_kerja_diterima,

                    "prod_kerja_beban_kerja"        => $prod_kerja_beban_kerja,
                    "prod_kerja_prestasi_kerja"     => $prod_kerja_prestasi_kerja,
                    "prod_kerja_kondisi_kerja"      => $prod_kerja_kondisi_kerja,
                    "prod_kerja_kelangkaan_profesi" => $prod_kerja_kelangkaan_profesi,
                    "prod_kerja_diterima"           => $prod_kerja_diterima,

                    "tambahan_tpp"              => $tambahan_tpp,
                    "pengurangan_tpp"           => $pengurang_tpp,
                    "jumlah_tpp_diterima"       => $grand_total
                );



                if ($check) {
                    // UPDATE


                    $data       = array(
                        "tpp_beban_kerja"           => $tpp_beban_kerja,
                        "tpp_prestasi_kerja"        => $tpp_prestasi_kerja,
                        "tpp_kondisi_kerja"         => $tpp_kondisi_kerja,
                        "tpp_kelangkaan_profesi"    => $tpp_kelangkaan_profesi,
                        "total_tpp"                 => $total_tpp,
                        "nilai_disiplin_kerja"      => $nilai_disiplin_kerja,
                        "nilai_produktivitas_kerja" => $nilai_produktivitas_kerja,
                        "dis_kerja_beban_kerja"     => $dis_kerja_beban_kerja,
                        "dis_kerja_prestasi_kerja"  => $dis_kerja_prestasi_kerja,
                        "dis_kerja_kondisi_kerja"   => $dis_kerja_kondisi_kerja,
                        "dis_kerja_kelangkaan_profesi"  => $dis_kerja_kelangkaan_profesi,
                        "dis_kerja_diterima"            => $dis_kerja_diterima,

                        "prod_kerja_beban_kerja"        => $prod_kerja_beban_kerja,
                        "prod_kerja_prestasi_kerja"     => $prod_kerja_prestasi_kerja,
                        "prod_kerja_kondisi_kerja"      => $prod_kerja_kondisi_kerja,
                        "prod_kerja_kelangkaan_profesi" => $prod_kerja_kelangkaan_profesi,
                        "prod_kerja_diterima"           => $prod_kerja_diterima,
                        "tambahan_tpp"              => $tambahan_tpp,
                        "pengurangan_tpp"           => $pengurang_tpp,
                        "jumlah_tpp_diterima"       => $grand_total
                    );

                    $where      = array(
                        "id_pegawai"        => $id_pegawai,
                        "periode"           => $periode
                    );

                    $insert_update     = $this->M_crud->update("tb_tpp", $data, $where);
                } else {
                    // INSERT
                    $data       = array(
                        "id_pegawai"                    => $id_pegawai,
                        "periode"                       => $periode,
                        "tpp_beban_kerja"               => $tpp_beban_kerja,
                        "tpp_prestasi_kerja"            => $tpp_prestasi_kerja,
                        "tpp_kondisi_kerja"             => $tpp_kondisi_kerja,
                        "tpp_kelangkaan_profesi"        => $tpp_kelangkaan_profesi,
                        "total_tpp"                     => $total_tpp,
                        "nilai_disiplin_kerja"          => $nilai_disiplin_kerja,
                        "nilai_produktivitas_kerja"     => $nilai_produktivitas_kerja,
                        "dis_kerja_beban_kerja"         => $dis_kerja_beban_kerja,
                        "dis_kerja_prestasi_kerja"      => $dis_kerja_prestasi_kerja,
                        "dis_kerja_kondisi_kerja"       => $dis_kerja_kondisi_kerja,
                        "dis_kerja_kelangkaan_profesi"  => $dis_kerja_kelangkaan_profesi,
                        "dis_kerja_diterima"            => $dis_kerja_diterima,

                        "prod_kerja_beban_kerja"        => $prod_kerja_beban_kerja,
                        "prod_kerja_prestasi_kerja"     => $prod_kerja_prestasi_kerja,
                        "prod_kerja_kondisi_kerja"      => $prod_kerja_kondisi_kerja,
                        "prod_kerja_kelangkaan_profesi" => $prod_kerja_kelangkaan_profesi,
                        "prod_kerja_diterima"           => $prod_kerja_diterima,
                        "tambahan_tpp"                  => $tambahan_tpp,
                        "pengurangan_tpp"               => $pengurang_tpp,
                        "jumlah_tpp_diterima"           => $grand_total
                    );

                    $insert_update     = $this->M_crud->insert("tb_tpp", $data);
                }

                $row['nama']                    = $item->nama;
                $row['nama_jabatan']            = $item->nama_jabatan;
                $row['jumlah_hari_kerja']       = $item->jumlah_hari_kerja . " Hari";

                $result[]       = $row;

                redirect(base_url("TPP/detailTPP/$periode"));
            }
        } else {

            $this->session->set_flashdata('error', 'Data TPP tidak ditemukan, Periksa Kembali Data Capaian Kerja & Rekapitulasi Presensi');
            redirect(base_url("TPP"));
        }
    }

    function loadBesaranTppListDatatables()
    {

        $besaran_tpp            = $this->M_besaran_tpp->loadDataBesaranTppDatatables();

        $data               = array();
        $no                 = $_POST['start'];

        $i                  = 0;
        foreach ($besaran_tpp as $item) {
            $no++;
            $row        = array();

            $row[]      = $item->nama_jabatan;
            $row[]      = $item->beban_kerja > 0 ? "Rp " . number_format($item->beban_kerja, 2, ',', '.') : '-';
            $row[]      = $item->prestasi_kerja > 0 ? "Rp " . number_format($item->prestasi_kerja, 2, ',', '.') : '-';
            $row[]      = $item->kondisi_kerja > 0 ? "Rp " . number_format($item->kondisi_kerja, 2, ',', '.') : '-';
            $row[]      = $item->kelangkaan_profesi > 0 ? "Rp " . number_format($item->kelangkaan_profesi, 2, ',', '.') : '-';
            $row[]      = $item->tambahan_tpp > 0 ? "Rp " . number_format($item->tambahan_tpp, 2, ',', '.') : '-';

            $total_tpp  = $item->beban_kerja + $item->prestasi_kerja + $item->kondisi_kerja + $item->kelangkaan_profesi + $item->tambahan_tpp;

            $row[]      = $total_tpp > 0 ? "Rp " . number_format($total_tpp, 2, ',', '.') : '';
            $row[]      = "
            <button data-id='$item->id_besaran_tpp' class='btn btn-xs btn-success' onclick='editNilai($item->id_besaran_tpp)' title='Edit Besaran TPP'><i class='fa fa-edit'></i></button>
            <button data-id='$item->id_besaran_tpp' class='btn btn-xs btn-danger' onclick='deleteNilai($item->id_besaran_tpp)' title='Hapus Besaran TPP'><i class='fa fa-trash'></i></button>
            ";

            $data[]     = $row;
            $i++;
        }

        $output         = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->M_besaran_tpp->count_all(),
            "recordsFiltered"   => $this->M_besaran_tpp->count_filtered(),
            "data"              => $data,
        );

        // output to json format

        echo json_encode($output);
    }

    function loadJabatanListOption()
    {
        $jabatan           = $this->M_besaran_tpp->loadJabatanList();

        $result     = "<option value=''>-- Pilih Jabatan --</option>";

        foreach ($jabatan as $item) {
            $result .= "<option value='$item->id_jabatan'>$item->nama_jabatan</option>";
        }

        echo $result;
    }

    function add()
    {
        $id_jabatan         = $this->input->post("jabatan");

        $beban_kerja        = $this->input->post("beban_kerja");
        $prestasi_kerja     = $this->input->post("prestasi_kerja");
        $kondisi_kerja      = $this->input->post("kondisi_kerja");
        $kelangkaan_profesi = $this->input->post("kelangkaan_profesi");
        $tambahan_tpp       = $this->input->post("tambahan_tpp");

        $data           = array(
            "id_jabatan"            => $id_jabatan,
            "beban_kerja"           => $beban_kerja,
            "prestasi_kerja"        => $prestasi_kerja,
            "kondisi_kerja"         => $kondisi_kerja,
            "kelangkaan_profesi"    => $kelangkaan_profesi,
            "tambahan_tpp"          => $tambahan_tpp
        );

        $insert         = $this->M_crud->insert("tb_besaran_tpp", $data);

        if ($insert) {
            $response_status        = "success";
            $response_message       = "Berhasil menyimpan data Besaran TPP";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal menyimpan data Besaran TPP";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function edit()
    {
        $id_besaran_tpp     = $this->input->post("id_besaran_tpp");

        $besaran_tpp        = $this->M_besaran_tpp->getDetailBesaranTPP($id_besaran_tpp);

        if ($besaran_tpp) {
            $response_data      = $besaran_tpp;
            $response_status    = "success";
            $response_message   = "Berhasil";
        } else {
            $response_data      = null;
            $response_status    = "failed";
            $response_message   = "Gagal mendapatkan Data Besaran TPP";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message,
            "data"          => $response_data
        ));
    }

    function Update()
    {
        $id_jabatan         = $this->input->post("jabatan");

        $beban_kerja        = $this->input->post("beban_kerja");
        $prestasi_kerja     = $this->input->post("prestasi_kerja");
        $kondisi_kerja      = $this->input->post("kondisi_kerja");
        $kelangkaan_profesi = $this->input->post("kelangkaan_profesi");
        $tambahan_tpp       = $this->input->post("tambahan_tpp");

        $data           = array(
            "beban_kerja"           => $beban_kerja,
            "prestasi_kerja"        => $prestasi_kerja,
            "kondisi_kerja"         => $kondisi_kerja,
            "kelangkaan_profesi"    => $kelangkaan_profesi,
            "tambahan_tpp"          => $tambahan_tpp
        );

        $where          = array(
            "id_jabatan"            => $id_jabatan
        );

        $update             = $this->M_crud->update("tb_besaran_tpp", $data, $where);

        if ($update) {
            $response_status        = "success";
            $response_message       = "Berhasil mengedit Besaran TPP";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal mengedit Besaran TPP";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function delete()
    {
        $id_besaran_tpp         = $this->input->post("id_besaran_tpp");

        $where             = array(
            "id_besaran_tpp"  => $id_besaran_tpp
        );

        $delete     = $this->M_crud->delete("tb_besaran_tpp", $where);

        if ($delete) {
            $response_status        = "success";
            $response_message       = "Berhasil menghapus Besaran TPP";
        } else {
            $response_status        = "failed";
            $response_message       = "Gagal menghapus Besaran TPP";
        }

        echo json_encode(array(
            "status"        => $response_status,
            "message"       => $response_message
        ));
    }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );


        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
