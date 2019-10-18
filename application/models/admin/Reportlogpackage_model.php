<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportlogpackage_model
 *
 * @author Prasan Srisopa
 */
class Reportlogpackage_model extends CI_Model{
    //put your code here
    public function countreport($search) {
        $this->db->join('shop', 'log_package.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%' 
                or action_text LIKE '%$search%'  
           ) ");
        }
        return $this->db->count_all_results('log_package');
    }
    
    public function getReport($params = array(),$search) {
        $this->db->select('log_package.action_text,
                        shop.shop_name,
                        log_package.date_modify');
        $this->db->join('shop', 'log_package.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or action_text LIKE '%$search%'  
           ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_package.date_modify', 'DESC');
        return $this->db->get('log_package');
    }
}

