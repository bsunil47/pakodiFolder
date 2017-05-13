<?php

class Communication_model extends CI_Model {

    private $from_email = "pakodiadmin@gmail.com";

    function __construct() {

        parent::__construct();
    }

    function send_recover_code($data) {

        $to = $data['email']; // note the comma
// subject
        $subject = 'Password Change';
        $url = base_url();
        $message = $data['message'];
// message
        $message = "<html><head></head><body><a href='{$url}frontend/changepassword/{$message}'>" . "Change password link" . '</a></body></html>';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
        $headers .= "To: " . $data['firstname'] . " <" . $data['email'] . ">" . "\r\n";
        $headers .= "From: Icheck <{$this->from_email}>" . "\r\n";

// Mail it


        if (mail($to, $subject, $message, $headers) == true) {
            return true;
        } else {
            return false;
        }
    }

    function merchant_invitation($data) {

        $to = $data['email']; // note the comma
// subject
        $subject = 'Merchant Signup';
        $url = base_url();
        $message = $data['message'];
// message
        $message = "<html><head></head><body>{$data['customer_name']} sent you  invitation <a href='{$url}frontend/merchantsignup/{$message}'>" . "Signup" . '</a></body></html>';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
        $headers .= "To: " . $data['firstname'] . " <" . $data['email'] . ">" . "\r\n";
        $headers .= "From: Icheck <{$this->from_email}>" . "\r\n";

// Mail it


        if (mail($to, $subject, $message, $headers) == true) {
            return true;
        } else {
            return false;
        }
    }

    function send_activation_code($data) {
        $to = $data['email'];
        $subject = 'Activation Link'; // subject
        // message
        $message = '';
        return $this->madrilmail($message, $to, $subject);

//    $message = '<html><head><title>EasyTag Activation link</title></head>
//                <body>
//                <p>Hi ' . $data['firstname'] . ',</br></p>
//                <p>Please activate your account <a href=' . base_url() . 'activate/' . $data['activation_code'] . '>Activation Link</a></p>
//                </body>
//                </html>';
// To send HTML mail, the Content-type header must be set
//    $headers = "MIME-Version: 1.0" . "\r\n";
//    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//// Additional headers
//    $headers .= 'To: ' . $data['firstname'] . ' <' . $data['email'] . '>' . "\r\n";
//    $headers .= 'From: EasyTag <' . FROM_EMAIL . '>' . "\r\n";
//// Mail it
//    mail($to, $subject, $message, $headers);
    }

    public function sendinvitation($data) {

        $to = $data['email'];
        $subject = 'Collaborator Invitation'; // subject
        // message
        $message = '';
        return $this->madrilmail($message, $to, $subject);
    }

    function contactus($data) {
        $name = $data['cname'];
        $from = $data['cemail'];
        $message = $data['cmessage'];
        $to = FROM_EMAIL;
        $subject = "Contact Us Enquire";
        // message
        $body = '';
        $response = $this->madrilmail($body, $to, $subject, $from, $name);
        if ($response[0]['status'] == 'sent') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function madrilmail($message, $to, $subject, $from_email = 'noreply@mindtree.in', $from_name = '360 Degrees') {
        $this->load->library('mandrill');

        $mandrill_ready = NULL;

        try {

            $this->mandrill->init($this->config->item('mandrill_api_key'));
            $mandrill_ready = TRUE;
        } catch (Mandrill_Exception $e) {

            $mandrill_ready = FALSE;
        }

        if ($mandrill_ready) {
            //Send us some email!
            $email = array(
                'html' => $message, //Consider using a view file
                'text' => 'This is my plaintext message',
                'subject' => $subject,
                'from_email' => $from_email,
                'from_name' => $from_name,
                'to' => array(array('email' => $to)) //Check documentation for more details on this one
                    //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
            );

            return $result = $this->mandrill->messages_send($email);
        }
    }

    public function send_mail($email) {
        //sending email to friend will intiate here
        $this->load->library('email');


        $this->email->initialize($config);

        $message = '<html><body>';
        $message .= '<div>Dear ' . $_POST['firstname'] . ' ,</div>';
        $message .= '<div>To Know the offers in your location go to this app Icheck account please click on the following link.</div>';
        $message .= '<div><a href="http://192.168.0.102/vijay/icheck/apicustomer/activate/' . $data['info']['user_id'] . '>icheck activation link</a></div>';
        $message .= '</body></html>';

        $this->email->from('info@icheck.com', 'Icheck');
        $this->email->to($email);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Icheck:App Invitation');
        $this->email->message($message);

        $this->email->send();

        return $this->email->print_debugger();
    }

    public function emailblast($id, $email, $message) {
        $mcolumns = array('M.business_name', 'M.contact', 'U.email');
        $this->common_model->initialise('merchant as M');
        $this->common_model->join_tables = array('users' => "users as U");
        $this->common_model->join_on = "M.user_id = U.id";
        $where = "M.user_id = $id";
        $mdata = $this->common_model->get_record_single($where, $mcolumns);

        $to = $email; // note the comma
// subject
        $subject = 'Mail to Folloer';
        // message

        $message = "<html><head></head><body>{$message}<br>{$mdata->business_name}<br>{$mdata->email}<br>{$mdata->contact}</body></html>";

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
        $headers .= "To: " . $email . "\r\n";
        $headers .= "From: {$mdata->email}" . "\r\n";
        if (mail($to, $subject, $message, $headers) == true) {
            return true;
        } else {
            return false;
        }
    }
    
    function send_Activate_code($data)
     {
         $to = $data['email']; // note the comma // subject
         $subject = 'Activation Code';
         $url = base_url();
         $message = $data['message'];
// message
         $message = "<html><head></head><body>". "Activation Code:{$message}" . '</body></html>';

// To send HTML mail, the Content-type header must be set
         $headers = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n";

// Additional headers
         $headers .= "To: " . $data['name'] . " <" . $data['email'] . ">" . "\r\n";
         $headers .= "From: Pakodi <{$this->from_email}>" . "\r\n";

// Mail it


         if (mail($to, $subject, $message, $headers) == true) {
             return true;
         } else {
             return false;
         }
     }

      function send_password($data)
     {
         $to = $data['email']; // note the comma // subject
         $subject = 'Pakodi App Create Job Credentials';
         $url = base_url();
         //$password = $data['password'];
// message
        
        $message = '<html><body>';
        $message .= '<div>Dear ' . $data['name'] . ' ,</div>';
        $message .= '<div>Pakodi App Content Create Job Credentials</div>';
        $message .= '<div>Username : ' . $data['email'] . '</div>';
        $message .= '<div>Password : ' . $data['password'] . '</div>';
        if($data['contentowner_id']!=""){
        $message .= '<div>Your Content Owner Id : ' . $data['contentowner_id'] . '</div>';
        }
        $message .= '<div><a href="http://183.82.107.134:81/pakodi/">Pakodi App Create Job Link</a></div>';
        if($data['contentowner_id']!=""){
        $message .= '<div>Please Use the above Contentowner Id for Uploading the data through Create Job Link </div>';
        }
        $message .= '</body></html>';

// To send HTML mail, the Content-type header must be set
         $headers = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n";

// Additional headers
         $headers .= "To: " . $data['name'] . " <" . $data['email'] . ">" . "\r\n";
         $headers .= "From: Pakodi <{$this->from_email}>" . "\r\n";

// Mail it


         if (mail($to, $subject, $message, $headers) == true) {
             return true;
         } else {
             return false;
         }
     }

}

?>
