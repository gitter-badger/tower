<?php
class Util_Guid {
    public $valueBeforeMD5;
    public $valueAfterMD5;

    public function Util_Guid() {
        $this->getGuid();
    }

    public function getGuid() {
        $address = NetAddress::getLocalHost();
        $this->valueBeforeMD5 = $address->toString() . ':' .
            System::currentTimeMillis() . ':' . Random::nextLong();
        $this->valueAfterMD5 = md5($this->valueBeforeMD5);
    }

    public function newGuid() {
        $Guid = new Util_Guid();
        return $Guid;
    }

    public function toString() {
        $raw = strtoupper($this->valueAfterMD5);
        return substr($raw ,0 ,8) . '-' . substr($raw, 8, 4) . '-' .
            substr($raw, 12, 4) . '-' . substr($raw, 16, 4) . '-' .
            substr($raw, 20);
    }
}

class  System {
    public static function currentTimeMillis() {
        //echo microtime();
        list($usec,  $sec)  =  explode(" ",microtime());
        return  $sec.substr($usec,  2,  3);
    }
}

class  NetAddress {
    public $Name = 'localhost';
    public $IP = '127.0.0.1';

    public static function getLocalHost() {
        $address = new NetAddress();
        $address->IP = $_SERVER["SERVER_ADDR"];
        return $address;
    }

    public function toString() {
        return strtolower($this->Name . '/' . $this->IP);
    }

}

class Random {

    public static function nextLong() {
        $tmp = rand(0,1) ? '-' : '';
        return $tmp . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) .
            rand(100, 999) . rand(100, 999);
    }

}
