<?php

class Report_model extends CI_Model{
    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function getAssets(){
        $result = array();
        $accountname = array();
        $j = 0;
        $this->db->select('debit_info, debit_amount');
        $this->db->where('typeD_id', 1);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['debit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($a[$i], $accountname)){}
                    else{
                        $accountname[$j] = $a[$i];
                $result[$j] = json_encode(array("account"=>$a[$i], "value" =>  $amount));
                $j++;
                    }
                }
        }
        }
        $this->db->select('credit_info');
        $this->db->where('typeC_id', 1);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['credit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($a[$i], $accountname)){}
                    else{
                        $accountname[$j] = $a[$i];
                $result[$j] = json_encode(array("account"=>$a[$i], "value" =>  $amount));
                $j++;
                    }
                }
        }
        $this->db->select('debit_info');
        $this->db->where('typeD_id', 7);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['debit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($a[$i], $accountname)){}
                    else{
                        $accountname[$j] = $a[$i];
                $result[$j] = json_encode(array("account"=>$a[$i], "value" =>  $amount));
                $j++;
                    }
                    }
                }
            }
        }
        return $result;
    }
    public function getLiabilities(){
        $result = array();
        $accountname = array();
        $j = 0;
        $this->db->select('debit_info');
        $this->db->where('typeD_id', 2);
        $this->db->where('month_entry', date('m-Y'));
        $liabilities = $this->db->get('journal_entries');
        $liabilities = $liabilities->result_array();
        foreach($liabilities as $l){
            $l = json_decode($l['debit_info']);
            for($i = 0; $i< count($l); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $l[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($l[$i], $accountname)){}
                    else{
                        $accountname[$j] = $l[$i];
                $result[$j] = json_encode(array("account"=>$l[$i], "value" =>  (-1)*$amount));
                $j++;
                    }
                }
        }
        }
        $this->db->select('credit_info');
        $this->db->where('typeC_id', 2);
        $this->db->where('month_entry', date('m-Y'));
        $liabilities = $this->db->get('journal_entries');
        $liabilities = $liabilities->result_array();
        foreach($liabilities as $l){
            $l = json_decode($l['credit_info']);
            for($i = 0; $i< count($l); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $l[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($l[$i], $accountname)){}
                    else{
                        $accountname[$j] = $l[$i];
                $result[$j] = json_encode(array("account"=>$l[$i], "value" =>  (-1)*$amount));
                $j++;
                    }
                }
        }
        }
        return $result;
    }
    public function getOE(){
        $result = array();
        $this->db->select('credit_info');
        $this->db->where('typeC_id', 3);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['credit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                $result[$i] = json_encode(array("account"=>$a[$i], "value" =>  (-1)*$amount));
                }
        }
        }
        return $result;
    }
    public function getOW(){
        $result = array();
        $this->db->select('debit_info, debit_amount');
        $this->db->where('typeD_id', 4);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['debit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                $result[$i] = json_encode(array("account"=>$a[$i], "value" =>  $amount));
                }
        }
        }
        return $result;
    }
    public function getExpenses(){
        $result = array();
        $j= 0;
        $accountname = array();
        $k  = 0;
        $this->db->select('debit_info');
        $this->db->where('typeD_id', 6);
        $this->db->where('month_entry', date('m-Y'));
        $assets = $this->db->get('journal_entries');
        $assets = $assets->result_array();
        foreach($assets as $a){
            $a = json_decode($a['debit_info']);
            for($i = 0; $i< count($a); $i++){
                $d_amount = 0;
                $c_amount = 0;    
                $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($a[$i], $accountname)){
                    }
                else{       
                    $accountname[$k] = $a[$i]; 
                    $result[$k] = json_encode(array("account"=>$a[$i], "value" =>  $amount));
                    $k++;
                }
                }
        }
        }
        return $result;
    }
    public function getRevenues(){
        $result = array();
        $j = 0;
        $accountname = array();
        $this->db->select('credit_info');
        //$this->db->where('typeD_id', 6);
        $this->db->where('typeC_id', 5);
        $this->db->where('month_entry', date('m-Y'));
        $rev = $this->db->get('journal_entries');
        $rev = $rev->result_array();
        foreach($rev as $a){
            $a = json_decode($a['credit_info']);
            for($i = 0; $i< count($a); $i++){
            $d_amount = 0;
            $c_amount = 0;    
            $amount = 0;
                $account = strtolower(str_replace(" ", "", $a[$i]));
                $this->db->select('debit');
                $debit = $this->db->get($account);
                $debit = $debit->result_array();
                foreach($debit as $debt){
                    $d_amount += $debt['debit'];
                }
                $this->db->select('credit');
                $credit = $this->db->get($account);
                $credit = $credit->result_array();
                foreach($credit as $c){
                    $c_amount += $c['credit'];
                }
                $amount = $d_amount-$c_amount;
                if($amount == 0){}
                else{
                    if(in_array($a[$i], $accountname)){}
                    else{
                        $accountname[$j] = $a[$i];
                $result[$j] = json_encode(array("account"=>$a[$i], "value" =>  (-1)*$amount));
                $j++;
                    }
                }
        }
        }
        return $result;
    }

    public function getSassets(){
        $depData = array();
        $accountname = array();
        $this->db->select('*');
        $this->db->where('type_id >', 7);
        $types = $this->db->get('type');
        $types = $types->result_array();
        $j = 0;
        foreach ($types as $t){
            $this->db->select('credit_info, debit_info');
            $this->db->where('typeC_id', $t['type_id']);
            $accountName = $this->db->get('journal_entries');
            $accountName = $accountName->result_array();
            if(!empty($accountName)){
            $depData[$j] = json_decode($accountName[0]['credit_info']);
            $depAccount[$j] = json_decode($accountName[0]['debit_info']);
            $depAccount[$j] = explode(" ", $depAccount[$j][0]);
            for($i = 2; $i< count($depAccount[$j]); $i++){
                print_r(implode(" ",$depAccount[$j]));
                // $depAccounts[$k] = implode(" ", $depAccount[$j][$i]);
                // $k++;
            }
            $depData[$j] = $depData[$j][0];
            $j++;
            }
        }
        $d_amount = 0;
        $c_amount = 0;    
        $amount = 0;
        for($i = 0; $i< count($depData); $i++){
            $accountName = strtolower(str_replace(" ", "", $depData[$i]));
            $this->db->select('debit');
            $debit = $this->db->get($accountName);
            $debit = $debit->result_array();
            foreach($debit as $debt){
                $d_amount += $debt['debit'];
            }
            $this->db->select('credit');
            $credit = $this->db->get($accountName);
            $credit = $credit->result_array();
            foreach($credit as $c){
                $c_amount += $c['credit'];
            }
            $amount = $d_amount-$c_amount;
            if($amount == 0){}
            else{             
                if(in_array($depData[$i], $accountname)){}
                else{       
                    $accountname[$j] = $depData[$i]; 
            $result[$i] = json_encode(array("account"=>$depData[$i], "value" =>  (-1*$amount)));
            $j++;
                }
            }        }

        return $result;
    }
}
?>