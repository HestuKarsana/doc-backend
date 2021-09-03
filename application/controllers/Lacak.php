<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M'); 

class Lacak extends REST_Controller{

    public function insert_get(){
        $data = $this->getData_get();
        $object = new stdClass();
        $object = (object) $data;
        $this->response($object);
    }

    public function getData_get(){
        $noresi   = $this->noresi();
        foreach ($noresi as $key) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://apiexpos.mile.app/public/v1/connote/'.$key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


            $headers = array();
            $headers[] = 'X-Api-Key: 04e5185fa9402cf4c06faac5dee754d40452f2c8';
            $headers[] = 'Accept: application/';
            $headers[] = 'Content-Type: application/';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            // $data[] = json_decode($result, true);
            $custom = json_decode($result, true);
            // return $data;
            $cus[] = $custom['connote_customfield'];
        }
        // $this->response($data);
        return $cus;
    }

    private function connote_customfield_get(){
        $data = $this->getData_get();
        $field = $data['connote_customfield'];
        $connote_customfield = array (
            'connote_id' =>$data['connote_id'],
            'statusRetur' =>$field['statusRetur'],
            'COD' =>$field['COD'],
            'ID_Pelanggan_Korporat' =>$field['id_pelanggan_korporat'],
            'cod_value' =>$field['cod_value'],
            'fee_value' =>$field['fee_value'],
            'total_cod' =>$field['total_cod'],
            'lumpsum_connote_amount' =>$field['lumpsum_connote_amount'],
            'expired_pks' =>$field['expired_pks'],
            'minimumweight' =>$field['minimumweight'],
            'pks_no' =>$field['pks_no'],
            'rekening_no' =>$field['rekening_no'],
            'npwp_number' =>$field['npwp_number'],
            'tariff_field' =>$field['tariff_field'],
            'Jenis_Barang' =>$field['Jenis_Barang'],
            'ref_no' =>$field['ref_no'],
            'instruksi_pengiriman' =>$field['instruksi_pengiriman'],
            'idUserSAP' =>$field['idUserSAP'],
            'idKorporatConnote'=>$field['idKorporatConnote'],
            // 'billingStatus' =>$field['billingStatus'],
            'nopen'=>$field['nopen'],
            'nokprk' =>$field['nokprk'],
            'regional' =>$field['regional'],
            'destination_reg' =>$field['destination_reg'],
            'destination_kprk' =>$field['destination_kprk'],
            'destination_nopen' =>$field['destination_nopen'],
            'location_id' =>$field['location_id'],
            'location_name' =>$field['location_name'],
            'final_swp' =>$field['final_swp'],
            'virtual_account' =>$field['virtual_account'],
            'cod_collected'=>$field['cod_collected'],
            'timeArrived'=>$field['timeArrived'],
            'timePredictionArrived'=>$field['timePredictionArrived'],
            'destination_location'=>$field['destination_location'],
            // 'timeLate' =>$field['timeLate'],
            'is_over_sla' =>$field['is_over_sla'],
            'sla_duration' =>$field['sla_duration'],
            'sla_duration_minutes' =>$field['sla_duration_minutes'],
            'C_is_Late' =>$field['C_is_Late'],
            'C_Delivery'=>$field['C_Delivery'],
            'deliverySuccessTime' =>$field['deliverySuccessTime'],
            'first_attempt_time' =>$field['first_attempt_time'],
            'username' =>$field['history_tracking']['user']['username'],
            'full_name'=>$field['history_tracking']['user']['full_name'],
        );
        return $connote_customfield;
    }

    public function tes_get() {
        $date   = date('ymd');
        for ($x = 1; $x <= 1000; $x++) {
            $invID = str_pad($x, 7, '0', STR_PAD_LEFT);
            $resi[]   = 'P'.$date.''.$invID;
            $data = $resi;
          }
        return $data;
        // $this->response($data);
    }

    private function noresi(){
        $date   = date('ymd');
        for ($x = 1; $x <= 1; $x++) {
            $invID = str_pad($x, 7, '0', STR_PAD_LEFT);
            $resi[]   = 'P'.$date.''.$invID;
            $data = $resi;
          }
        return $data;
        // $this->response($data);
    }

    public function data_get(){
        $noresi   = $this->noresi();
        foreach ($noresi as $key) {
            # code...
            // $str[]      = 'https://apiexpos.mile.app/public/v1/connote/'.$key;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://apiexpos.mile.app/public/v1/connote/'.$key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


            $headers = array();
            $headers[] = 'X-Api-Key: 04e5185fa9402cf4c06faac5dee754d40452f2c8';
            $headers[] = 'Accept: application/';
            $headers[] = 'Content-Type: application/';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            $data[] = json_decode($result, true);
            // $custom = json_decode($data['custom_field'], true);
            // return $data;
            $data   = $data;
        }
        $this->response($data);
        // return $data;
    }
}