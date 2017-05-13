<?php

class Communication_model extends CI_Model
{

    private $from_email = "pakodiadmin@gmail.com";

    function __construct()
    {

        parent::__construct();
    }

    public function send_mail($email)
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $message = '<html><body>';
        $message .= '<div>Dear ' . $_POST['username'] . ' ,</div>';
        $message .= '<div>&nbsp;</div>';
        $message .= '<div>' . $_POST['message'] . '</div>';
        $message .= '<div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>';
        $message .= '<div><b>Thanks & Regards,</b></div>';
        $message .= '<div>Pakodi App</div>';
        $message .= '<div> Email : ' . $this->from_email . '</div>';
        $message .= '</body></html>';

        $this->email->from($this->from_email, 'PAKODI');
        $this->email->to($email);
        $this->email->subject($_POST['subject']);
        $this->email->message($message);
        $this->email->send();
        //return $this->email->print_debugger(); exit;
    }


    function contactus($data)
    {
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

    protected function madrilmail($message, $to, $subject, $from_email = 'noreply@m.comn', $from_name = '360 Degrees')
    {
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


    function send_Activate_code($data)
    {
        $to = $data['email']; // note the comma // subject
        $subject = 'Activation Code';
        $url = base_url();
        $message = $data['message'];
// message
        $message = "<html><head></head><body>" . "Activation Code:{$message}" . '</body></html>';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

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
        $user_type = $data['user_type'];
        if ($user_type == 4) {
            $user = 'Content Owner Create Job';
        }
        if ($user_type == 3) {
            $user = 'Moderator';
        }
        if ($user_type == 1) {
            $user = 'Admin User';
        }
        $to = $data['email']; // note the comma // subject
        $subject = 'Pakodi App ' . $user . ' Credentials';
        $url = base_url();
// message
        $message = '<html><body>';
        $message .= '<div>Dear ' . $data['name'] . ' ,</div>';
        $message .= '<div>Pakodi App  ' . $user . ' Credentials</div>';
        $message .= '<div>Username : ' . $data['email'] . '</div>';
        $message .= '<div>Password : ' . $data['password'] . '</div>';
        if ($user_type == 4) {
            $message .= '<div>Your Content Owner Id : ' . $data['contentowner_id'] . '</div>';
            $message .= '<div>Please Use the above Contentowner Id for Uploading the data through Create Job Link </div>';
        }
        $message .= "<div><a href='{$url}'>Pakodi App $user Link</a></div>";
        $message .= '</body></html>';
//echo $message; exit;
// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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

    function send_moderator($data)
    {
        $to = $data['email']; // note the comma // subject
        $subject = 'Pakodi App Moderator Credentials';
        $url = base_url();
        //$password = $data['password'];
// message

        $message = '<html><body>';
        $message .= '<div>Dear ' . $data['name'] . ' ,</div>';
        $message .= '<div>Pakodi App Dubs Moderator Credentials</div>';
        $message .= '<div>Username : ' . $data['email'] . '</div>';
        $message .= '<div>Password : ' . $data['password'] . '</div>';
        // $message .= '<div><a href="http://183.82.107.134:81/pakodi/moderator/">Pakodi App Moderator Link</a></div>';
        $message .= "<div><a href='{$url}moderator/'>Pakodi App Moderator Link</a></div>";
        $message .= '</body></html>';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

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

    function send_recover_code($data) {
        $to = $data['email'];
        $subject = 'Password Change';
        $url = base_url();
        $path = $data['path'];
        ($path == 'frontend') ? $pathi = 'Content Owner' : $pathi = $path;
        $message = $data['message'];
        $message = "<html><head></head><body><div><img src='{$url}images/logo.png' /></div>"
            . "<div>&nbsp;</div>"
            . "<div>Please click on the following link to Change the Password</div>"
            . "<div>&nbsp;</div>"
            . "<div><a href='{$url}frontend/forgot_changepassword/{$message}/{$path}'>" . "Change password link" .
            '</a></div></body></html>';
        // To send HTML mail, the Content-type header must be set
        //echo $message; exit;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Additional headers
        $headers .= "To: " . $data['name'] . " <" . $data['email'] . ">" . "\r\n";
        $headers .= "From: Pakodi <{$this->from_email}>" . "\r\n";
        if (mail($to, $subject, $message, $headers) == true) {// Mail it
            return true;
        } else {
            return false;
        }
    }


}

?>
