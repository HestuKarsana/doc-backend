<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Report_Detail_Transaksi extends REST_Controller{
    public function index_post(){
        $regional       = $this->post('regional');
        // $kprk         = $this->post('kprk');
        $start          = $this->post('startdate');
        $end            = $this->post('enddate');
        $response['status'] = false; //default status
        $response['message']['global'] = 'Data tidak ditemukan'; //default message is object 

        if($regional != ''){ //cek if data is extis
            //then return status true
            $q  = $this->regional($regional,$start, $end);
            $response['status'] = true;
            $response['message']['global'] = new StdClass(); //must in object, if no message create empty object
            $response['result']  = $q;
         }else{
            $q  = $this->all($start, $end);
            $response['status'] = true;
            $response['message']['global'] = new StdClass(); //must in object, if no message create empty object
            $response['result']  = $q;
        }
        
        $this->response($response, 200);

    }

    private function all($start, $end){
        $this->db->select("c.connote_code, c.connote_service as service,cc.COD, c.connote_sender_name as pengirim, cc.user, 
                            cc.fullname as nama_pengguna,c.connote_service_price as ongkir,  cc.PPN , cc.pph ,cc.NONPPN ,
                            c.connote_surcharge_amount as asuransi, c.connote_amount as total , cc.cod_value, cc.fee_value,cc.total_cod,
                            cc.nopen, cc.regional , ldc.location_code , ldc.location_type ");
        $this->db->from('connote c');
        $this->db->join('connote_customfield cc','c.connote_id = cc.connote_id','LEFT');
        $this->db->join('location_data_created ldc','c.connote_id = ldc.connote_id','LEFT');
        $this->db->where("date_format(c.created_at, '%Y-%m-%d') between '$start' and '$end'");
        $this->db->order_by('c.connote_id', 'ASC');
        $q = $this->db->get()->result_array();
        return $q;
    }

    private function regional($regional,$start, $end){
        $this->db->select("c.connote_code, c.connote_service as service,cc.COD, c.connote_sender_name as pengirim, cc.user, 
        cc.fullname as nama_pengguna,c.connote_service_price as ongkir,  cc.PPN , cc.pph ,cc.NONPPN ,
        c.connote_surcharge_amount as asuransi, c.connote_amount as total , cc.cod_value, cc.fee_value,cc.total_cod,
        cc.nopen, cc.regional , ldc.location_code , ldc.location_type ");
        $this->db->from('connote c');
        $this->db->join('connote_customfield cc','c.connote_id = cc.connote_id','LEFT');
        $this->db->join('location_data_created ldc','c.connote_id = ldc.connote_id','LEFT');
        $this->db->where('cc.regional', $regional);
        $this->db->where("date_format(c.created_at, '%Y-%m-%d') between '$start' and '$end'");
        $this->db->order_by('c.connote_id', 'ASC');
        $q = $this->db->get()->result_array();
        return $q;
    }

    private function kprk($regional, $kprk,$start, $end){
        $this->db->select("c.connote_code, c.connote_service as service,cc.COD, c.connote_sender_name as pengirim, cc.user, 
        cc.fullname as nama_pengguna,c.connote_service_price as ongkir,  cc.PPN , cc.pph ,cc.NONPPN ,
        c.connote_surcharge_amount as asuransi, c.connote_amount as total , cc.cod_value, cc.fee_value,cc.total_cod,
        cc.nopen, cc.regional , ldc.location_code , ldc.location_type ");
        $this->db->from('connote c');
        $this->db->join('connote_customfield cc','c.connote_id = cc.connote_id','LEFT');
        $this->db->join('location_data_created ldc','c.connote_id = ldc.connote_id','LEFT');
        $this->db->where('cc.regional', $regional);
        $this->db->where('cc.nopen', $kprk);
        $this->db->where("date_format(c.created_at, '%Y-%m-%d') between '$start' and '$end'");
        $this->db->order_by('c.connote_id', 'ASC');
        $q = $this->db->get()->result_array();
        return $q;
    }
}
