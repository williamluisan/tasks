<?php

defined('BASEPATH') OR exit('Direct access script is not allowed');

class Sodium extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Do encryption
     * 
     * @param   text            plain text
     * @param   A_private_key   private key A
     * @param   B_public_key    public key B
     * @param   throw_off_bytes salt
     * 
     * @return  string
     */
    private function _encrypt($text, $A_private_key, $B_public_key, $throw_off_bytes)
    {
        $encryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey($A_private_key, $B_public_key);
        $chipertext = sodium_crypto_box($text, $throw_off_bytes, $encryption_key);

        return $chipertext;
    }

    /**
     * Do decryption
     * 
     * @param   text            plain text
     * @param   B_private_key   private key B
     * @param   A_public_key    public key A
     * @param   throw_off_bytes salt
     * 
     * @return  string
     */
    private function _decrypt($text, $B_private_key, $A_public_key, $throw_off_bytes)
    {
        $decryption_key = sodium_crypto_box_keypair_from_secretkey_and_publickey($B_private_key, $A_public_key);
        $plaintext = sodium_crypto_box_open($text, $throw_off_bytes, $decryption_key);
        
        return $plaintext;
    }

    public function index()
    {
        $data = [];
        $choice = $this->input->post('choice');
        
        $text = $this->input->post('string');

        // encrypt submit
        if ($choice == '1') {
            $A_private_key = base64_decode($this->input->post('private_key'));
            $B_public_key = base64_decode($this->input->post('public_key'));
            $salt = base64_decode($this->input->post('salt'));
            $data['encrypt'] = [
                'chipertext' => base64_encode($this->_encrypt($text, $A_private_key, $B_public_key, $salt))
            ];
        }

        // decrypt submit
        if ($choice == '2') {
            $a = base64_decode($text);
            $B_private_key = base64_decode($this->input->post('private_key'));
            $A_public_key = base64_decode($this->input->post('public_key'));
            $salt = base64_decode($this->input->post('salt'));
            $data['decrypt'] = [
                'plaintext' => $this->_decrypt($a, $B_private_key, $A_public_key, $salt)
            ];
        }

        // get key submit
        if ($choice == '3') {
            $salt = base64_encode(random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES));

            $A_key_pair = sodium_crypto_box_keypair();
            $A_public_key = base64_encode(sodium_crypto_box_publickey($A_key_pair));
            $A_private_key = base64_encode(sodium_crypto_box_secretkey($A_key_pair));

            $B_key_pair = sodium_crypto_box_keypair();
            $B_public_key = base64_encode(sodium_crypto_box_publickey($B_key_pair));
            $B_private_key = base64_encode(sodium_crypto_box_secretkey($B_key_pair));

            $data['generate'] = [
                'public_key_A' => $A_public_key,
                'private_key_A' => $A_private_key,
                'public_key_B' => $B_public_key,
                'private_key_B' => $B_private_key,
                'salt' => $salt
            ];
        }

        $this->load->view('sodium', $data);
    }
}