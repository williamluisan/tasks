<?php

defined('BASEPATH') OR exit('Direct access script is not allowed');

class Contact extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->ch = curl_init();
    }

    public function index()
    {
        $access_token = $this->session->userdata()['access_token'];
     
        // build query parameters
        $query_params = [
            'personFields' => 'names,emailAddresses',
            'access_token' => $access_token
        ];
        $params = http_build_query($query_params);
        $request_url = "https://people.googleapis.com/v1/people/me/connections?${params}";

        // do curl request
        curl_setopt($this->ch, CURLOPT_URL, $request_url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_VERBOSE, TRUE);

        $result = json_decode(curl_exec($this->ch))->connections;

        $data['contacts'] = $result;
        
        $this->load->view('contact', $data);
    }
}