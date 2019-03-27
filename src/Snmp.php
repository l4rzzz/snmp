<?php

namespace L4rzzz\Snmp;

/**
 *  SNMP Client
 *
 *  Supports SNMPv2c and SNMPv3.
 *
 *  @package L4rzzz\Snmp
 */
class Snmp
{
    private $host;
    private $auth;
    private $version;
    private $timeout;
    private $retries;
    private $trimResponse;
    
    /**
     * Constructor
     *
     * the $auth array needs different keys for SNMPv2 and SNMPv3.
     * v2: 'ro' and/or 'rw'
     * v3: 'securityName','authProtocol','authKey','privProtocol','privKey'
     *
     * @param string $host
     * @param array $auth
     * @param string $version
     * @param integer $timeout
     * @param integer $retries
     * @param boolean $trimResponse
     *
     * @return \L4rzzz\Snmp\Snmp
     */
    public function __construct($host, $auth, $version = 'v2c', $timeout = 1000000, $retries = 5, $trimResponse = true)
    {
        if ($version == 2) {
            $this->version == 'v2c';
        } elseif ($version == 3) {
            $this->version = 'v3';
        } else {
            $this->version = $version;
        }
        $this->host = $host;
        $this->auth = $auth;
        $this->timeout = $timeout;
        $this->retries = $retries;
        $this->trimResponse = $trimResponse;
    }

    /**
     * SNMP get
     *
     * @param string $oid
     *
     * @return string
     */
    public function get($oid)
    {
        if ($this->version == 'v2c') {
            $get = $this->getV2c($oid);
        } elseif ($this->version == 'v3') {
            $get = $this->getV3($oid);
        }
        
        if ($this->trimResponse == true) {
            return $this->trimResponseValue($get);
        } else {
            return $get;
        }
    
    }
    
    /**
     *  SNMP walk
     *
     * @param string $oid
     *
     * @return array
     */
    public function walk($oid)
    {
        if ($this->version == 'v2c') {
            $walk = $this->walkV2c($oid);
        } elseif ($this->version == 'v3') {
            $walk = $this->walkV3($oid);
        }
        
        $ret = [];
        if ($this->trimResponse == true) {
            foreach ($walk as $oid => $value) {
                $ret[$oid] = $this->trimResponseValue($value);
            }
            return $ret;
        } else {
            return $walk;
        }
    }
    
    /**
     * SNMP set
     *
     * @param string $oid
     * @param string $type data type
     * @param string $value data value
     *
     * @return string
     */
    public function set($oid, $type, $value)
    {
        if ($this->version == 'v2c') {
            $set = $this->setV2c($oid, $type, $value);
        } elseif ($this->version == 'v3') {
            $set = $this->setV3($oid, $type, $value);
        }
        return $set;
    }
    
    /**
     * SNMP get v2c
     *
     * @param string $oid
     *
     * @return string
     */
    protected function getV2c($oid)
    {
        if ($getV2c = snmp2_get($this->host, $this->auth['ro'], $oid, $this->timeout, $this->retries)) {
            return $getV2c;
        } else {
            throw new \Exception('snmp2_get failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * SNMP walk v2c
     *
     * @param string $oid
     *
     * @return array
     */
    protected function walkV2c($oid)
    {
        if ($walkV2c = snmp2_real_walk($this->host, $this->auth['ro'], $oid, $this->timeout, $this->retries)) {
            return $walkV2c;
        } else {
            throw new \Exception('snmp2_real_walk failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * SNMP set v2c
     *
     * @param string $oid
     * @param string $type
     * @param string $value
     *
     * @return string
     */
    protected function setV2c($oid, $type, $value)
    {
        if ($setV2c = snmp2_set($this->host, $this->auth['rw'], $oid, $type, $value, $this->timeout, $this->retries)) {
            return $setV2c;
        } else {
            throw new \Exception('snmp2_set failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * SNMP get v3
     *
     * @param string $oid
     *
     * @return string
     */
    protected function getV3($oid)
    {
        if ($getV3 = snmp3_get(
            $this->host,
            $this->auth['securityName'],
            $this->auth['securityLevel'],
            $this->auth['authProtocol'],
            $this->auth['authKey'],
            $this->auth['privProtocol'],
            $this->auth['privKey'],
            $oid,
            $this->timeout,
            $this->retries
        )) {
            return $getV3;
        } else {
            throw new \Exception('snmp3_get failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * SNMP walk v3
     *
     * @param string $oid
     *
     * @return array
     */
    protected function walkV3($oid)
    {
        if ($walkV3 = snmp3_real_walk(
            $this->host,
            $this->auth['securityName'],
            $this->auth['securityLevel'],
            $this->auth['authProtocol'],
            $this->auth['authKey'],
            $this->auth['privProtocol'],
            $this->auth['privKey'],
            $oid,
            $this->timeout,
            $this->retries
        )) {
            return $walkV3;
        } else {
            throw new \Exception('snmp3_real_walk failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * SNMP set v3
     *
     * @param string $oid
     *
     * @return string
     */
    protected function setV3($oid, $type, $value)
    {
        if ($setV3 = snmp3_real_walk(
            $this->host,
            $this->auth['securityName'],
            $this->auth['securityLevel'],
            $this->auth['authProtocol'],
            $this->auth['authKey'],
            $this->auth['privProtocol'],
            $this->auth['privKey'],
            $oid,
            $type,
            $value,
            $this->timeout,
            $this->retries
        )) {
            return $setV3;
        } else {
            throw new \Exception('snmp3_set failed; ip:' . $this->host . ', oid:' . $oid);
        }
    }
    
    /**
     * Trim SNMP response of its object type
     *
     * @param string $value
     *
     * @return string
     */
    protected function trimResponseValue($value)
    {
        $search = array(
            'INTEGER: ',
            'Hex-STRING: ',
            'STRING: ',
            'Gauge32: ',
            'IpAddress: ',
            'Timeticks: ',
            'Counter32: ',
            'Counter64: ',
        );
        $value = str_replace($search, '', $value);
        
        //remove oid from oid response
        if (strpos($value, 'OID:')===0 && strpos($value, '::')) {
            $value = substr($value, strpos($value, '::')+2);
        }
        
        //isolates value between double quotes " "
        if (preg_match('/"([^"]+)"/', $value, $m)) {
            return $m[1];
        } else {
            return $value;
        }
    }
    
    /**
     * Isolates last digit from an OID (often used as device ID)
     *
     * @param string $oid
     *
     * @return string
     */
    protected function getLastOidDigit($oid)
    {
        return substr($oid, strrpos($oid, '.')+1);
    }
    
    /**
     * Isolates last two digits from an OID
     *
     * @param string $oid
     *
     * @return array arr[0]=last oid, arr[1]=2nd last oid
     */
    protected function getLastTwoOidDigit($oid)
    {
        $arr = explode('.', $oid);
        $ret[0] = $arr[count($arr)-1]; //last oid digit
        $ret[1] = $arr[count($arr)-2]; //2nd last oid digit
        return $ret;
    }
    
    /**
     * Isolates last three digits from an OID
     *
     * @param string $oid
     *
     * @return array arr[0]=last oid, arr[1]=2nd last oid, arr[2]=3rd last oid
     */
    protected function getLastThreeOidDigit($oid)
    {
        $arr = explode('.', $oid);
        $ret[0] = $arr[count($arr)-1]; //last oid digit
        $ret[1] = $arr[count($arr)-2]; //2nd last oid digit
        $ret[2] = $arr[count($arr)-3]; //3rd last oid digit
        return $ret;
    }
    
    /**
     * Explode OID and reverse array
     *
     * @param string $oid
     *
     * @return array
     */
    protected function explodeAndReverse($oid)
    {
        return array_reverse(explode('.', $oid));
    }
    
    /**
     * Remove spaces from strings if trimResponse is true
     *
     * @param string $str
     *
     * @return string
     */
    protected function removeSpaces($str)
    {
        if ($this->trimResponse == true) {
            return str_replace(' ', '', $str);
        } else {
            return $str;
        }
    }
}
