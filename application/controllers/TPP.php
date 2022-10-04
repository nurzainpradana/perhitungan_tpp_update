<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $result         = $this->M_tpp->loadTppByPeriode($periode);
        $periode        = strtoupper($this->tgl_indo($periode));


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'PERHITUNGAN TAMBAHAN PENGHASILAN KECAMATAN SETU KABUPATEN BEKASI');
        $sheet->mergeCells('A1:W1');
        $sheet->setCellValue('A2', "BULAN $periode");
        $sheet->mergeCells('A2:W2');


        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(32);
        $sheet->getColumnDimension('C')->setWidth(32);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(18);
        $sheet->getColumnDimension('H')->setWidth(18);
        $sheet->getColumnDimension('I')->setWidth(18);
        $sheet->getColumnDimension('J')->setWidth(18);
        $sheet->getColumnDimension('K')->setWidth(18);
        $sheet->getColumnDimension('L')->setWidth(18);
        $sheet->getColumnDimension('M')->setWidth(18);
        $sheet->getColumnDimension('N')->setWidth(18);
        $sheet->getColumnDimension('O')->setWidth(18);
        $sheet->getColumnDimension('P')->setWidth(18);
        $sheet->getColumnDimension('Q')->setWidth(18);
        $sheet->getColumnDimension('R')->setWidth(18);
        $sheet->getColumnDimension('S')->setWidth(18);
        $sheet->getColumnDimension('T')->setWidth(18);
        $sheet->getColumnDimension('U')->setWidth(18);
        $sheet->getColumnDimension('V')->setWidth(18);
        $sheet->getColumnDimension('W')->setWidth(18);

        $sheet->setCellValue("A3", "NO");
        $sheet->mergeCells('A3:A5');
        $sheet->setCellValue("B3", "NAMA");
        $sheet->mergeCells('B3:B5');
        $sheet->setCellValue("C3", "JABATAN");
        $sheet->mergeCells('C3:C5');

        $sheet->setCellValue("D3", "BESARAN TPP");
        $sheet->mergeCells('D3:H3');
        $sheet->mergeCells("D4:H4");

        $sheet->setCellValue("D5", "BEBAN KERJA");
        $sheet->setCellValue("E5", "PRESTASI KERJA");
        $sheet->setCellValue("F5", "KONDISI KERJA");
        $sheet->setCellValue("G5", "KELANGKAAN PROFESI");
        $sheet->setCellValue("H5", "TOTAL TPP");

        $sheet->getStyle("D5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("D5")->getFill()->getStartColor()->setARGB('FFC000');

        $sheet->getStyle("E5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("E5")->getFill()->getStartColor()->setARGB('00B0F0');

        $sheet->getStyle("F5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("F5")->getFill()->getStartColor()->setARGB('92D050');

        $sheet->getStyle("G5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("G5")->getFill()->getStartColor()->setARGB('FFFF00');


        $sheet->setCellValue("I3", "DISIPLIN KERJA");
        $sheet->mergeCells('I3:N3');
        $sheet->setCellValue("J4", "40%");
        $sheet->mergeCells("J4:N4");

        $sheet->setCellValue("I4", "NILAI");
        $sheet->mergeCells("I4:I5");


        $sheet->setCellValue("J5", "BEBAN KERJA");
        $sheet->setCellValue("K5", "PRESTASI KERJA");
        $sheet->setCellValue("L5", "KONDISI KERJA");
        $sheet->setCellValue("M5", "KELANGKAAN PROFESI");
        $sheet->setCellValue("N5", "DITERIMA");

        $sheet->getStyle("J5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("J5")->getFill()->getStartColor()->setARGB('FFC000');

        $sheet->getStyle("K5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("K5")->getFill()->getStartColor()->setARGB('00B0F0');

        $sheet->getStyle("L5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("L5")->getFill()->getStartColor()->setARGB('92D050');

        $sheet->getStyle("M5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("M5")->getFill()->getStartColor()->setARGB('FFFF00');


        $sheet->setCellValue("O3", "PRODUKTIVITAS KERJA");
        $sheet->mergeCells('O3:T3');
        $sheet->setCellValue("P4", "60%");
        $sheet->mergeCells("P4:T4");

        $sheet->setCellValue("O4", "NILAI");
        $sheet->mergeCells("O4:O5");


        $sheet->setCellValue("P5", "BEBAN KERJA");
        $sheet->setCellValue("Q5", "PRESTASI KERJA");
        $sheet->setCellValue("R5", "KONDISI KERJA");
        $sheet->setCellValue("S5", "KELANGKAAN PROFESI");
        $sheet->setCellValue("T5", "DITERIMA");

        $sheet->getStyle("P5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("P5")->getFill()->getStartColor()->setARGB('FFC000');

        $sheet->getStyle("Q5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("Q5")->getFill()->getStartColor()->setARGB('00B0F0');

        $sheet->getStyle("R5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("R5")->getFill()->getStartColor()->setARGB('92D050');

        $sheet->getStyle("S5")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle("S5")->getFill()->getStartColor()->setARGB('FFFF00');


        $sheet->setCellValue("U3", "TAMBAHAN TPP");
        $sheet->setCellValue("U4", "Pj / Plt / JABATAN FUNGSIONAL BUKAN PENYETARAAN DENGAN TUGAS TAMBAHAN SEBAGAI KOORDINATOR / SUBKOORDINATOR");
        $sheet->mergeCells("U4:U5");

        $sheet->setCellValue("V3", "PENGURANGAN TPP");
        $sheet->setCellValue("V4", "KELEBIHAN BAYAR DESEMBER / TERJARING GERAKAN DISIPLIN APARATUR /MANIPULASI DATA / LHKPN / LHKASN");

        $sheet->mergeCells("V4:V5");



        $sheet->setCellValue("W3", "JUMLAH TPP DITERIMA");
        $sheet->mergeCells("W3:W5");



        // $sheet->getStyle("A3:H6")->applyFromArray($styleArray);

        $row    = 1;
        foreach (range('A', 'W') as $col) {
            $sheet->setCellValue("$col" . "6", $row);
            $row++;
        }

        // $sheet->setCellValue("A6", "1");
        // $sheet->setCellValue("B6", "2");
        // $sheet->setCellValue("C6", "3");
        // $sheet->setCellValue("D6", "4");
        // $sheet->setCellValue("E6", "5");
        // $sheet->setCellValue("F6", "6");
        // $sheet->setCellValue("G6", "7");
        // $sheet->setCellValue("H6", "8");

        $styleArray = [
            'font'  => array(
                'size'  => 11,
                'bold'  => true,
                'name'  => 'Bookman Old Style'
            )
        ];

        $sheet->getStyle('A6:W6')->applyFromArray($styleArray);
        $sheet->getStyle('A6:W6')->getAlignment()->setHorizontal('center');



        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                ],
            ],
            'font'  => array(
                'size'  => 11,
                'name'  => 'Bookman Old Style'
            )
        ];

        $sheet->getStyle("A3:W6")->applyFromArray($styleArray);
        $sheet->getStyle("A3:W6")->getAlignment()->setWrapText(true);


        $styleArray = [
            'font'  => array(
                'size'  => 7,
                'name'  => 'Bookman Old Style'
            )
        ];

        $sheet->getStyle('U4:V5')->applyFromArray($styleArray);

        $sheet->getRowDimension('3')->setRowHeight(30);
        $sheet->getRowDimension('4')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(30);


        $row        = 7;
        $no         = 1;
        

        foreach ($result as $item) {

            $sheet->setCellValue("A$row", $no);
            $sheet->setCellValue("B$row", $item->nama);
            $sheet->setCellValue("C$row", $item->nama_jabatan);
            $sheet->setCellValue("D$row", $item->tpp_beban_kerja > 0 ? $item->tpp_beban_kerja : '-');
            $sheet->setCellValue("E$row", $item->tpp_prestasi_kerja);
            $sheet->setCellValue("F$row", $item->tpp_kondisi_kerja);
            $sheet->setCellValue("G$row", $item->tpp_kelangkaan_profesi > 0 ? $item->tpp_kelangkaan_profesi : '-');
            $sheet->setCellValue("H$row", $item->total_tpp);
            $sheet->setCellValue("I$row", $item->nilai_disiplin_kerja . " %");
            $sheet->setCellValue("J$row", $item->dis_kerja_beban_kerja > 0 ? $item->dis_kerja_beban_kerja : '-');
            $sheet->setCellValue("K$row", $item->dis_kerja_prestasi_kerja);
            $sheet->setCellValue("L$row", $item->dis_kerja_kondisi_kerja);
            $sheet->setCellValue("M$row", $item->dis_kerja_kelangkaan_profesi > 0 ? $item->dis_kerja_kelangkaan_profesi : '-');
            $sheet->setCellValue("N$row", $item->dis_kerja_diterima);
            $sheet->setCellValue("O$row", $item->nilai_produktivitas_kerja . " %");
            $sheet->setCellValue("P$row", $item->prod_kerja_beban_kerja > 0 ? $item->prod_kerja_beban_kerja : '-');
            $sheet->setCellValue("Q$row", $item->prod_kerja_prestasi_kerja);
            $sheet->setCellValue("R$row", $item->prod_kerja_kondisi_kerja);
            $sheet->setCellValue("S$row", $item->prod_kerja_kelangkaan_profesi > 0 ? $item->prod_kerja_kelangkaan_profesi : '-');
            $sheet->setCellValue("T$row", $item->prod_kerja_diterima);
            $sheet->setCellValue("U$row", $item->tambahan_tpp);
            $sheet->setCellValue("V$row", $item->pengurangan_tpp);
            $sheet->setCellValue("W$row", $item->jumlah_tpp_diterima);

            print_r($item);

            $no++;
            $row++;
        }

        $sheet->getStyle("D7:W$row")->getNumberFormat()->setFormatCode('#,##0.00');

        $row--;




        $styleArray = [
            'font'  => array(
                'size'  => 11,
                'bold'  => true,
                'name'  => 'Bookman Old Style'
            )
        ];

        $sheet->getStyle('A1:H2')->applyFromArray($styleArray);
        $sheet->getStyle('A1:W5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:W5')->getAlignment()->setVertical('center');


        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'font'  => array(
                'size'  => 11,
                'name'  => 'Bookman Old Style'
            )
        ];

        $sheet->getStyle("A7:W$row")->applyFromArray($styleArray);
        $sheet->getStyle("A7:W$row")->getAlignment()->setWrapText(true);


        $sheet->getStyle("A7:A$row")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A7:A$row")->getAlignment()->setVertical('center');


        $sheet->getStyle("B7:C$row")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("B7:C$row")->getAlignment()->setVertical('center');

        $sheet->getStyle("D7:W$row")->getAlignment()->setHorizontal('right');
        $sheet->getStyle("D7:W$row")->getAlignment()->setVertical('center');






        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');


        $filename = date('Y-m-d-His') . '-Data-User';
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
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
