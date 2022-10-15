
<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class M_user_access extends CI_Model
{

    var $table      = "tb_user";
    var $column     = array("nama", "nama_jabatan");
    var $order      = array("nama" => "asc");

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->search   = '';
    }

    private function _get_datatables_query()
    {
        $this->db->select("u.*, p.nama, j.nama_jabatan");
        $this->db->from("tb_user u");
        $this->db->join("tb_pegawai p", "p.id_pegawai = u.id_pegawai", "left");
        $this->db->join("tb_jabatan j", "j.id_jabatan = p.id_jabatan", "left");

        $i      = 0;

        foreach ($this->column as $item) {
            if (isset($_POST['search'])) {
                if ($_POST['search']['value']) ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
                $column[$i]     = $item;
            }

            $i++;
        }

        if (isset($_POST["periode"])) {
            $this->db->where("periode", $_POST["periode"]);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order      = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    

    function checkUserId($user_id)
    {
        $this->db->select("*");
        $this->db->from("tb_user");
        $this->db->where("user_id", $user_id);

        return $this->db->get()->row();
    }


    function loadDataUserAccessDatatables()
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

    public function loadJabatanList()
    {
        $this->db->select("*");
        $this->db->from($this->table);

        return $this->db->get()->result();
    }

    public function getDetailUserAccess($id_user_access)
    {
        $this->db->select("*");
        $this->db->from("tb_user");
        $this->db->where("id_user_access", $id_user_access);

        return $this->db->get()->row();
    }
}
