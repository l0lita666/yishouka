<?php
class Card{
	Protected $autoCheckFields = false;

    private $keys = "";
 
    /**
     * 构造，传递二个已经进行base64_encode的KEY与IV
     *
     * @param string $key
     * @param string $iv
     */
    function __construct($key)
    {
        $this->keys = $key;
        $this->keys = hash('sha256', $this->keys, true);
    }
 
     public function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-256-CBC', $this->keys, OPENSSL_RAW_DATA, $this->hexToStr($this->keys));
        $data = base64_encode($data);
        return bin2hex($data);
    }
 
    public function decrypt($input)
    {
		try{
			$decrypted = openssl_decrypt(base64_decode(pack("H*",$input)), 'AES-256-CBC', $this->keys, OPENSSL_RAW_DATA, $this->hexToStr($this->keys));
			return $decrypted;
		}catch (\Exception $e) {
			  echo $e->getMessage();
		  }
    }
 
    /*
      For PKCS7 padding
     */
 
    private function addpadding($string, $blocksize = 16) {
 
        $len = strlen($string);
 
        $pad = $blocksize - ($len % $blocksize);
 
        $string .= str_repeat(chr($pad), $pad);
 
        return $string;
 
    }
 
    private function strippadding($string) {
 
        $slast = ord(substr($string, -1));
 
        $slastc = chr($slast);
 
        $pcheck = substr($string, -$slast);
 
        if (preg_match("/$slastc{" . $slast . "}/", $string)) {
 
            $string = substr($string, 0, strlen($string) - $slast);
 
            return $string;
 
        } else {
 
            return false;
 
        }
 
    }
 
    function hexToStr($hex)
    {
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }

}