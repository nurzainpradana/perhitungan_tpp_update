
<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class M_besaran_tpp extends CI_Model
{

    var $table      = "tb_besaran_tpp";
    var $column     = array("nama_jabatan", "beban_kerja", "prestasi_kerja", "kondisi_kerja", "kelangkaan_profesi");
    var $order      = array("nama" => "asc");

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->search   = '';
    }

    function getDetailBesaranTPP($id_besaran_tpp)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id_besaran_tpp", $id_besaran_tpp);

        return $this->db->get()->row();
    }

    function loadJabatanList()
    {
        return $this->db->query("
        SELECT * FROM tb_jabatan j
        LEFT JOIN tb_besaran_tpp btpp ON bttp.id_jabatan = j.id_jabatan
        WHERE bttp.id_besaran_tpp IS NOT NULL
        ")->result();
    }





    private function _get_datatables_query()
    {
        $this->db->select("*");
        $this->db->from("tb_besaran_tpp bttp");
        $this->db->join("tb_jabatan j", "j.id_jabatan = bttp.id_jabatan", "left");

        $i      = 0;

        foreach ($this->column as $item) {
            if (isset($_POST['search'])) {
                if ($_POST['search']['value']) ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
                $column[$i]     = $item;
            }

            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order      = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function loadDataBesaranTppDatatables()
    {
        $this->_get_datatables_query();

        if (isset($_POST['length'])) {
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query      = $this->db->get();

        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();

        $query  = $this->db->get();

        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getDetailCapaianKinerja($id_capaian_kinerja)
    {
        $this->db->select("*");
        $this->db->from("tb_capaian_kerja");
        $this->db->where("id_capaian_kinerja", $id_capaian_kinerja);

        return $this->db->get()->row();
    }
}
