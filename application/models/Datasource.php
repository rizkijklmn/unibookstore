<?php

class Datasource extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_where($s_table_name, $a_clause = false)
    {
        if ($a_clause) {
            $query = $this->db->get_where($s_table_name, $a_clause);
        } else {
            $query = $this->db->get($s_table_name);
        }

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function get_where_object($s_table_name, $a_clause)
    {
        $query = $this->db->get_where($s_table_name, $a_clause);
        return ($query->row()) ? $query->row() : false;
    }

    public function generateKodePenerbit()
    {
        $query = "SELECT IDPenerbit FROM tb_penerbit ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            $row = $result->row();
            $latestCode = $row->IDPenerbit;
        } else {
            // If there is no code in the database, start with the first code
            $latestCode = 'PN-000';
        }
        $latestNumber = (int)substr($latestCode, 4);
        $newNumber = $latestNumber + 1;
        $newNumberFormatted = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        $newCode = 'PN-' . $newNumberFormatted;

        return $newCode;
    }

    public function generateKodeBuku()
    {
        $query = "SELECT IDBuku FROM tb_buku ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            $row = $result->row();
            $latestCode = $row->IDBuku;
        } else {
            // If there is no code in the database, start with the first code
            $latestCode = 'BK-000';
        }
        $latestNumber = (int)substr($latestCode, 4);
        $newNumber = $latestNumber + 1;
        $newNumberFormatted = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        $newCode = 'BK-' . $newNumberFormatted;

        return $newCode;
    }

    public function getBuku()
    {
        $query = $this->db->query("SELECT tb.*, tp.id as id_penerbit, tp.nama_penerbit FROM tb_buku as tb
        LEFT JOIN tb_penerbit as tp ON tp.id = tb.IDPenerbit");

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function getBukuUnderStock($stock)
    {
        $query = $this->db->query("SELECT tb.*, tp.id as id_penerbit, tp.nama_penerbit FROM tb_buku as tb
        LEFT JOIN tb_penerbit as tp ON tp.id = tb.IDPenerbit
        WHERE stock < $stock
        ");

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    # data penerbit
    public function insert_data_penerbit($a_data)
    {
        $this->db->trans_begin();
        $this->db->insert('tb_penerbit', $a_data);

        $id = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    public function update_data_penerbit($a_data, $id)
    {
        $this->db->trans_begin();
        $this->db->update('tb_penerbit', $a_data, ['id' => $id]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function delete_data_penerbit($id)
    {
        $this->db->delete('tb_penerbit', ['id' => $id]);
        return true;
    }

    # data buku
    public function insert_data_buku($a_data)
    {
        $this->db->trans_begin();
        $this->db->insert('tb_buku', $a_data);

        $id = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    public function update_data_buku($a_data, $id)
    {
        $this->db->trans_begin();
        $this->db->update('tb_buku', $a_data, ['id' => $id]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function delete_data_buku($id)
    {
        $this->db->delete('tb_buku', ['id' => $id]);
        return true;
    }


}
