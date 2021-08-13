<?php

defined('BASEPATH') OR exit('Direct access script is not allowed');

class Login extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->config('config_google_client');
    }

    public function index()
    {
        $data['client_id'] = $this->config->item('google_client')['client_id'];
        
        $this->load->view('login', $data);
    }

    public function authenticate()
    {
        // google api php client
        $google_client = new Google_Client();
        $google_client->setAuthConfig($this->config->item('google_client')['credentials_file_path']);
        $redirect_uri = 'http://localhost:8080';
        $google_client->setRedirectUri($redirect_uri);

        // get one time code from google sign-in
        $request = $this->input->post();
        $code = NULL;
        if ($request) {
            $code = $request['code'];
        }

        // get OAuth access token
        $request = $google_client->fetchAccessTokenWithAuthCode($code);
        $access_token = NULL;
        if ($request) {
            $access_token = $request['access_token'];

            // store in session
            $this->session->set_userdata('access_token', $access_token);
            $this->session->set_userdata('request', $request);

            echo json_encode(TRUE); exit();
        }

        echo json_encode(FALSE);
    }
}