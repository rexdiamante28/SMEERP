<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dragonpay {

	protected $CI;
        protected $paypanda_merchant_id = "PAYPANDA";

        protected $paypanda_merchant_password = "mxgoahPoPQzZKUD"; //live mrfbE5HcmtXPUZp test mxgoahPoPQzZKUD
		
	public function __construct(){
	       $this->CI =& get_instance();
	}

        public function get_payment_url($reference_number='',$amount,$description,$email,$currency,$param1,$param2,$spayment=2){ 

            $errors = array();
            $is_link = false;

            $mode = $spayment;
            
            $parameters = array(
                'merchantid' => $this->paypanda_merchant_id,
                'txnid' => $reference_number, 
                'amount' => number_format($amount,2,'.',''),
                'ccy' => $currency,
                'description' => $description,
                'email' => $email,
                'key' => $this->paypanda_merchant_password,
            );


            $digest_string = implode(':', $parameters);
            
            unset($parameters['key']);

            $parameters['digest'] = sha1($digest_string);
            $parameters['param1'] = $param1;
            $parameters['param2'] = $param2;
            $parameters['mode'] = $mode;

            $url = "";

            if(ENVIRONMENT=='production')
            {
                $url = 'https://gw.dragonpay.ph/Pay.aspx?';
            }
            else
            {
                $url = 'http://test.dragonpay.ph/Pay.aspx?';
            }

            $url .= http_build_query($parameters, '', '&');

            return $url;

        }


        public function log_postback($txnid,$refno,$status,$message,$procid,$digest,$param1,$param2)
        {
            $query="insert into sys_dragonpay_postback (txnid,refno,status,message,procid,digest,param1,param2,created,enabled)
             values (?,?,?,?,?,?,?,?,?,?)";

            $arguments = array(
                $txnid,
                $refno,
                $status,
                $message,
                $procid,
                $digest,
                $param1,
                $param2,
                date('Y-m-d H:i:s'),
                1
            );

            $this->CI->db->query($query,$arguments);
        }
}


//table for dragonpay postbacks: Note: potback variables depend on what you've sent dragonpay

/*CREATE TABLE `sys_dragonpay_postback` (
  `id` int(11) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `refno` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `message` varchar(255) NOT NULL,
  `procid` varchar(20) NOT NULL,
  `digest` varchar(100) NOT NULL,
  `param1` text DEFAULT NULL,
  `param2` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `sys_dragonpay_postback`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_dragonpay_postback`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;*/
