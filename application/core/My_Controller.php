<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author kesav
 */
class MY_Controller extends CI_Controller {

    protected $error;
    protected $flag = TRUE;

    function __construct() {
        parent::__construct();
    }

    public function update_by() {
        $data_post = $_POST;
        $data_array = $this->trim_addslashes($data_post);
        $data_array['updated_by'] = $this->session->userdata('admin_user_id');
        $data_array['updated_date'] = date("Y-m-d H:i:s");
        return $data_array;
    }

    public function _is_logged_in() {
        $logged = $this->session->userdata('id');
        if (!empty($logged)) {
            return true;
        } else {
            return false;
        }
    }

    public function _is_home_logged_in() {
        $logged = $this->session->userdata('user_id');
        if (!empty($logged)) {
            return true;
        } else {
            return false;
        }
    }

    public function _ismoderator_logged_in() { //used for moderator login
        $logged = $this->session->userdata('moderator_user_id');
        if (!empty($logged)) {
            return true;
        } else {
            return false;
        }
    }

    protected function trim_addslashes($data) {
        foreach ($data as $key => $value) {
            $pattern = "/\d{4}\-\d{2}\-\d{2}/";
            if (!preg_match($pattern, $value, $matches)) {
                if (is_string($value)) {
                    $data[$key] = addslashes(trim($value));
                }
            }
        }
        return $data;
    }

    public function setFlashmessage($type, $message) {
        $this->session->set_flashdata('type', $type);
        $this->session->set_flashdata('msg', $message);
    }

    protected function alph_check($data) {
        if (!preg_match("/^[a-zA-Z ]+$/", $data))
            return false;
        else
            return true;
    }

    protected function change_array($data) {
        foreach ($data as $value) {
            if (is_object($value)) {
                $data_arr[] = $this->object_to_array($value);
            } else {
                $data_arr[] = $value;
            }
        }
        return $data_arr;
    }

    private function object_to_array($data) {
        foreach ($data as $value) {
            if (is_array($value)) {
                $data_array = $this->object_to_array($value);
            } else {
                $data_array = $value;
            }
        }
        return $data_array;
    }

    protected function log($id, $list) {
        $url_to_save = "log/{$id}/" . date('Y') . '/' . date('z');
        if (!is_dir(FCPATH . $url_to_save)) {
            mkdir(FCPATH . $url_to_save, 0777, true);
            chmod(FCPATH . $url_to_save, 0777);
        }
        clearstatcache();
        $fp = fopen(FCPATH . $url_to_save . "/log_file.csv", 'a+');
        //or die('cant open file');
        //chmod(FCPATH . $url_to_save . "/log_file.csv", 0777);
        //foreach ($list as $fields) {
        fputcsv($fp, $list);
        //}
        fclose($fp);
    }

    protected function message_log($id, $data) {
        $url_to_save = "messages_log/{$id}/" . date('Y') . '/' . date('m');
        if (!is_dir(FCPATH . $url_to_save)) {
            mkdir(FCPATH . $url_to_save, 0777, true);
            chmod(FCPATH . $url_to_save, 0777);
        }
        $fp = fopen(FCPATH . $url_to_save . "/log_file.csv", 'a');
        //chmod(FCPATH . $url_to_save . "/log_file.csv", 0777);
        //foreach ($list as $fields) {
        fputcsv($fp, $data);
        //}
        fclose($fp);
    }

    protected function log_login($type) {
        $type;
        $flag = false;
        $url_to_save = "log/";
        if (!is_dir(FCPATH . $url_to_save)) {
            mkdir(FCPATH . $url_to_save, 0777, true);
            chmod(FCPATH . $url_to_save, 0777);
        }
        if (!is_file(FCPATH . $url_to_save . "/log_login.csv")) {
            $fp = fopen(FCPATH . $url_to_save . "/log_login.csv", 'a');
            chmod(FCPATH . $url_to_save . "/log_login.csv", 0777);
            fclose($fp);
        }
        $row = 1;
        $data_array = array();
        if (($handle = fopen(FCPATH . $url_to_save . "/log_login.csv", "r")) !== FALSE && filesize(FCPATH . $url_to_save . "/log_login.csv") != 0) {
//            if (($data = fgetcsv($handle)) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                if ($data[2] == date('Y-m-d') && $data[0] == $type) {
                    $flag = true;
                    $data_array[] = array($data[0], $data[1] + 1, $data[2]);
                } else {
                    if (strtotime($data[2]) > strtotime('-7 day')) {
                        $data_array[] = $data;
                    }
                }
            }
            fclose($handle);
            if (!$flag) {
                $data_array[] = array($type, 1, date('Y-m-d'));
            }
        } else {
            $data_array[] = array($type, 1, date('Y-m-d'));
        }
        $fp = fopen(FCPATH . $url_to_save . "/log_login.csv", 'w');
        foreach ($data_array as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        //foreach ($list as $fields) {
        //}
    }

    protected function send_push_notification($device_token, $message,$device_type, $custom_message = null){
        if($device_type == 1){
            $this->send_notifications($device_token, $message, $custom_message);
        }else{
            $this->send_gcm($device_token, $message, $custom_message);
        }
        return true;
    }

    protected function send_gcm($registration_id, $message, $custom_message = null)
    {
        // simple loading
        // note: you have to specify API key in config before
        $this->load->library('gcm');

        // simple adding message. You can also add message in the data,
        // but if you specified it with setMesage() already
        // then setMessage's messages will have bigger priority
        if(empty($custom_message)) {
           $this->gcm->setMessage($message);
        }

        // add recepient or few
        $this->gcm->addRecepient($registration_id);
        //$this->gcm->addRecepient('New reg id');

        // set additional data
        if(!empty($custom_message)){
            $custom_message['message'] =$message;
            $this->gcm->setData($custom_message);
        }


        // also you can add time to live
        $this->gcm->setTtl(500);
        // and unset in further
        $this->gcm->setTtl(false);

        // set group for messages if needed
        $this->gcm->setGroup('Test');
        // or set to default
        $this->gcm->setGroup(false);

        // then send
        if ($this->gcm->send())
            log_message('debug', 'Sending successful');
        else
            log_message('error', 'Some messages have errors');

        // and see responses for more info
        //print_r($this->gcm->status);
        //print_r($this->gcm->messagesStatuses); exit;
        return true;
        //die(' Worked.');
    }

    protected function send_notifications($device_token, $message, $custom_message = null) {
        $this->load->library('apn');
        $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
        $this->apn->connectToPush();
        // adding custom variables to the notification
        if (!empty($custom_message)) {
            $this->apn->setData($custom_message);
        }
        $send_result = $this->apn->sendMessage($device_token, $message, /* badge */ 1, /* sound */ 'default');
        if ($send_result) {
            //echo $send_result;
            log_message('debug', 'Sending successful');
        } else {
            //echo $this->apn->error;
            log_message('error', $this->apn->error);
        }
        $this->apn->disconnectPush();
        return;
    }

    protected function paypal() {
        $ch = curl_init();
        //$clientId = "AQ7Gg4iJdNh_upoi0hipIT5aD98XRV1RbmML_sMmWb9XXxhYOYJbuyQFL4ndO79tCe-26wllXROMAqT5";
        //$secret = "EFjFdoYxH4dplCgWo1uN4lsr9Y1x6H9x7bfpsEk3VHv4-aeYICiN13gXQJWa-Ii4SA5azPKx5r-LEvZE";
        $clientId = "AYtKD764o47AAXYdgXdnacYx9o8q_3XVIJ2pLJ4Zbyhj1Kik5jtIgsSXKSfjWiFQeCx9MUh2AZrV1J2V";
        $secret = "ELytwKytMUM6MZHT6KH2FoZ3JR9kSczDsUttBmghbMqJl5pX8ed7_9rzxUnREdteb3iAfffihZwzRzRW";
        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($ch);
        if (empty($result))
            die("Error: No response.");
        else {
            $json = json_decode($result);
            //print_r($json->access_token);
        }
        curl_close($ch);
        return $json->access_token;
    }

    protected function payout($access_token, $amount, $email, $senderid) {
        $ch = curl_init();
        $data = '{
"sender_batch_header": {
        "sender_batch_id": "' . $senderid . '",
        "email_subject": "You have a Payout!",
        "recipient_type": "EMAIL"
    },
    "items": [
        {
            "recipient_type": "EMAIL",
            "amount": {
                "value": ' . $amount . ',
                "currency": "AUD"
            },
            "receiver": "' . $email . '",
            "note": "Payment for recent icheck cashout",
            "sender_item_id": "' . $senderid . '"
        }
    ]
}';
        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payouts?sync_mode=true");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: Bearer $access_token",
                "Content-length: " . strlen($data))
        );
        $result1 = curl_exec($ch);
        if (empty($result1))
            die("Error: No response.");
        else {
            $json = json_decode($result1);
            //print_r($json);
        }
        curl_close($ch);
        return $json;
    }

    protected function key_date_array_f($type) {
        $data_array = array();
        $this->common_model->initialise($type);
        $data = $this->common_model->get_records(0, "date(datecreated) date, SUM(amount) as $type", 'DATE(datecreated) > DATE_SUB(CURDATE(), INTERVAL 7 DAY)', 'datecreated', 'ASC', 'date(datecreated)');
        foreach ($data as $key => $value) {
            $data_array[$value->date] = $value->$type;
        }
        return $data_array;
    }

    protected function insert_user_details($type, $data) {
        $this->common_model->initialise($type);
        $this->common_model->array = $data;
        return $this->common_model->insert_entry();
    }

    protected function select_name($language){
        $this->common_model->initialise('content_random_users');
        $name = $this->common_model->get_records(1, 'name, id', ['language_id'=>$language], $col = 'RAND()', $order = 'desc');
        return $name[0];
    }

    function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while( $current <= $last ) {
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }



}