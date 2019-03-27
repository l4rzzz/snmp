<?php

namespace L4rzzz\Snmp\Enterprise\Cisco;

/**
 * Class to interact with Cisco network devices.
 *
 * @package L4rzzz\Snmp
 */
class Cisco extends \L4rzzz\Snmp\Mgmt\Mib2
{
    
    /**
     * Instantiates \L4rzzz\Snmp\Snmp forcing trimResponse to true
     *
     * @param string $host
     * @param string $auth
     * @param string $version
     * @param string $timeout
     * @param string $retries
     * @param string $trimResponse
     *
     * @return \L4rzzz\Snmp\Enterprise\Cisco
     */
    public function __construct($host, $auth, $version = 'v2c', $timeout = 1000000, $retries = 5, $trimResponse = true)
    {
        $this->host = $host;
        $this->auth = $auth;
        $this->version = $version;
        $this->timeout = $timeout;
        $this->retries = $retries;
        $this->trimResponse = true;
        
        parent::__construct($this->host, $this->auth, $this->version, $this->timeout, $this->retries, $this->trimResponse);
    }
    
    /* CISCO-VTP-MIB */
    
    /**
     * Walk Vlan Table MIB
     *
     * @return array key=vlanId, value = array('vlanState' => '', 'id' => '', etc...)
     */
    public function walkVtpVlanTable()
    {
        $vtpVlanEntry = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1');
        
        $ret = [];
        foreach ($vtpVlanEntry as $oid => $value) {
            $oids = $this->getLastThreeOidDigit($oid);
            $ret[$oids[0]]['vlanId'] = $oids[0];
            
            switch ($oids[2]) {
                case 2:
                    $ret[$oids[0]]['vlanState'] = $this->convertVlanState($value);
                    break;
                case 3:
                    $ret[$oids[0]]['vlanType'] = $this->convertVlanType($value);
                    break;
                case 4:
                    $ret[$oids[0]]['vlanName'] = $value;
                    break;
                case 5:
                    $ret[$oids[0]]['vlanMtu'] = $value;
                    break;
                case 6:
                    $ret[$oids[0]]['vlanDot10Said'] = $value;
                    break;
                case 7:
                    $ret[$oids[0]]['vlanRingNumber'] = $value;
                    break;
                case 8:
                    $ret[$oids[0]]['vlanBridgeNumber'] = $value;
                    break;
                case 9:
                    $ret[$oids[0]]['vlanStpType'] = $this->convertVlanStpType($value);
                    break;
                case 10:
                    $ret[$oids[0]]['vlanParentVlan'] = $value;
                    break;
                case 18:
                    $ret[$oids[0]]['vlanIfIndex'] = $value;
                    break;
                default:
                    break;
            }
        }
        return $ret;
    }
    
    /**
     * Walk Vlan State
     *
     * @return array key=vlanId, value=state
     */
    public function walkVtpVlanState()
    {
        $vtpVlanState = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.2');
        
        $ret = [];
        foreach ($vtpVlanState as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanState($value);
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Type
     *
     * @return array key=vlanId, value=type
     */
    public function walkVtpVlanType()
    {
        $vtpVlanType = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.3');
        
        $ret = [];
        foreach ($vtpVlanType as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanType($value);
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Name
     *
     * @return array key=vlanId, value=name
     */
    public function walkVtpVlanName()
    {
        $vtpVlanName = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.4');
        
        $ret = [];
        foreach ($vtpVlanName as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Mtu
     *
     * @return array key=vlanId, value=mtu
     */
    public function walkVtpVlanMtu()
    {
        $vtpVlanMtu = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.5');
        
        $ret = [];
        foreach ($vtpVlanMtu as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan 802.10 SAID
     *
     * @return array key=vlanId, value=said
     */
    public function walkVtpVlanDot10Said()
    {
        $vtpVlanDot10Said = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.6');
        
        $ret = [];
        foreach ($vtpVlanDot10Said as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Ring Number
     *
     * @return array key=vlanId, value=ringNumber
     */
    public function walkVtpVlanRingNumber()
    {
        $vtpVlanRingNumber = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.7');
        
        $ret = [];
        foreach ($vtpVlanRingNumber as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Bridge Number
     *
     * @return array key=vlanId, value=bridge
     */
    public function walkVtpVlanBridgeNumber()
    {
        $vtpVlanBridgeNumber = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.8');
        
        $ret = [];
        foreach ($vtpVlanBridgeNumber as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Stp Type
     *
     * @return array key=vlanId, value=stpType
     */
    public function walkVtpVlanStpType()
    {
        $vtpVlanStpType = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.9');
        
        $ret = [];
        foreach ($vtpVlanStpType as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanStpType($value);
        }
        return $ret;
    }
    
    /**
     * Walk Vlan Parent Vlan
     *
     * @return array key=vlanId, value=parentVlan
     */
    public function walkVtpVlanParentVlan()
    {
        $vtpVlanParentVlan = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.10');
        
        $ret = [];
        foreach ($vtpVlanParentVlan as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Vlan ifIndex
     *
     * @return array key=vlanId, value=ifIndex
     */
    public function walkVtpVlanIfIndex()
    {
        $vtpVlanIfIndex = $this->walk('1.3.6.1.4.1.9.9.46.1.3.1.1.18');
        
        $ret = [];
        foreach ($vtpVlanIfIndex as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Convert VLAN stateId to readable
     *
     * @param integer $stateId
     *
     * @return string
     */
    private function convertVlanState($stateId)
    {
        switch ($stateId) {
            case 1:
                $state = 'operational';
                break;
            case 2:
                $state = 'suspended';
                break;
            case 3:
                $state = 'mtuTooBigForDevice';
                break;
            case 4:
                $state = 'mtuTooBigForTrunk';
                break;
            default:
                $state = $stateId;
                break;
        }
        return $state;
    }

    /**
     * Convert VLAN typeId to readable
     *
     * @param integer $typeId
     *
     * @return string
     */
    private function convertVlanType($typeId)
    {
        switch ($typeId) {
            case 1:
                $type = 'ethernet';
                break;
            case 2:
                $type = 'fddi';
                break;
            case 3:
                $type = 'tokenRing';
                break;
            case 4:
                $type = 'fddiNet';
                break;
            case 5:
                $type = 'trNet';
                break;
            case 6:
                $type = 'deprecated';
                break;
            default:
                $type = $typeId;
                break;
        }
        return $type;
    }
 
    /**
     * Convert VLAN stpTypeId to readable
     *
     * @param integer $typeId
     *
     * @return string
     */
    private function convertVlanStpType($typeId)
    {
        switch ($typeId) {
            case 1:
                $type = 'ieee';
                break;
            case 2:
                $type = 'ibm';
                break;
            case 3:
                $type = 'hybrid';
                break;
            default:
                $type = $typeId;
                break;
        }
        return $type;
    }

    /* CISCO-VTP-MIB : vlanTrunkPortTable */
    
    /**
     * Walk VLAN Trunk Port Table MIB
     *
     * @return array key=ifIndex, value = array('vlanTrunkPortDynamicState' => '', etc)
     */
    public function walkVlanTrunkPortTable()
    {
        $vlanTrunkPortTable = $this->walk('1.3.6.1.4.1.9.9.46.1.6.1.1');
        
        $ret = [];
        foreach ($vlanTrunkPortTable as $oid => $value) {
            $oids = $this->getLastTwoOidDigit($oid);
            $ret[$oids[0]]['ifIndex'] = $oids[0];
            
            switch ($oids[1]) {
                case 3:
                    $value = $this->convertVlanTrunkPortEncapsulationOperType($value);
                    $ret[$oids[0]]['vlanTrunkPortEncapsulationType'] = $value;
                    break;
                case 13:
                    $value = $this->convertVlanTrunkPortDynamicState($value);
                    $ret[$oids[0]]['vlanTrunkPortDynamicState'] = $value;
                    break;
                case 14:
                    $value = $this->convertVlanTrunkPortDynamicStatus($value);
                    $ret[$oids[0]]['vlanTrunkPortDynamicStatus'] = $value;
                    break;
                case 16:
                    $value = $this->convertVlanTrunkPortEncapsulationOperType($value);
                    $ret[$oids[0]]['vlanTrunkPortEncapsulationOperType'] = $value;
                    break;
                default:
                    break;
            }
        }
        return $ret;
    }
    
    /**
     * Walk VLAN Port Encapsulation Type
     *
     * @return array
     */
    public function walkVlanPortEncapsulationType()
    {
        $vlanPortEncapsulationType = $this->walk('1.3.6.1.4.1.9.9.46.1.6.1.1.3');
        
        $ret = [];
        foreach ($vlanPortEncapsulationType as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanTrunkPortEncapsulationOperType($value);
        }
        return $ret;
    }
    
    /**
     * Walk VLAN Port Dynamic State
     *
     * @return array
     */
    public function walkVlanTrunkPortDynamicState()
    {
        $vlanTrunkPortDynamicState = $this->walk('1.3.6.1.4.1.9.9.46.1.6.1.1.13');
        
        $ret = [];
        foreach ($vlanTrunkPortDynamicState as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanTrunkPortDynamicState($value);
        }
        return $ret;
    }
    
    /**
     * Walk VLAN Port Dynamic Status
     *
     * @return array
     */
    public function walkVlanTrunkPortDynamicStatus()
    {
        $vlanTrunkPortDynamicStatus = $this->walk('1.3.6.1.4.1.9.9.46.1.6.1.1.14');
        
        $ret = [];
        foreach ($vlanTrunkPortDynamicStatus as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanTrunkPortDynamicStatus($value);
        }
        return $ret;
    }
    
    /**
     * Walk VLAN Port Encapsulation Operation Type
     *
     * @return array
     */
    public function walkVlanTrunkPortEncapsulationOperType()
    {
        $vlanTrunkPortEncapsulationOperType = $this->walk('1.3.6.1.4.1.9.9.46.1.6.1.1.16');
        
        $ret = [];
        foreach ($vlanTrunkPortEncapsulationOperType as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->convertVlanTrunkPortEncapsulationOperType($value);
        }
        return $ret;
    }
    
    /**
     * Convert VLAN Trunk Dynamic State to readable
     *
     * @param integer $dynamicState
     *
     * @return string
     */
    private function convertVlanTrunkPortDynamicState($dynamicState)
    {
        switch ($dynamicState) {
            case 1:
                $state = 'on';
                break;
            case 2:
                $state = 'off';
                break;
            case 3:
                $state = 'desirable';
                break;
            case 4:
                $state = 'auto';
                break;
            case 5:
                $state = 'onNoNegotiate';
                break;
            default:
                $state = $dynamicState;
                break;
        }
        return $state;
    }
    
    /**
     * Convert VLAN Trunk Port Dynamic Status to readable
     *
     * @param integer $dynamicStatus
     *
     * @return string
     */
    private function convertVlanTrunkPortDynamicStatus($dynamicStatus)
    {
        switch ($dynamicStatus) {
            case 1:
                $status = 'trunking';
                break;
            case 2:
                $status = 'notTrunking';
                break;
                $status = $dynamicStatus;
                break;
        }
        return $status;
    }
    
    /**
     * Convert VLAN Trunk Port Encapsulation Type to readable
     *
     * @param integer $operType
     *
     * @return string
     */
    private function convertVlanTrunkPortEncapsulationOperType($operType)
    {
        switch ($operType) {
            case 1:
                $type = 'isl';
                break;
            case 2:
                $type = 'dot10';
                break;
            case 3:
                $type = 'lane';
                break;
            case 4:
                $type = 'dot1Q';
                break;
            case 5:
                $type = 'negotiating';
                break;
            case 6:
                $type = 'notApplicable';
                break;
            default:
                $type = $operType;
                break;
        }
        return $type;
    }
    
    /**
     * Convert SNMP hex date to dec format 1999-12-31 23:59:59
     *
     * @param string $hex
     *
     * @return string
     */
    protected function dateHexToDec($hex)
    {
        $str = $this->removeSpaces($this->trimResponseValue($hex));
        $strArray = str_split($str, 2);
        $ret = hexdec($strArray[0].''.$strArray[1]).'-'. //year
            str_pad(hexdec($strArray[2]), 2, '0', STR_PAD_LEFT).'-'. //month
            str_pad(hexdec($strArray[3]), 2, '0', STR_PAD_LEFT).' '. //day
            str_pad(hexdec($strArray[4]), 2, '0', STR_PAD_LEFT).':'. //hour
            str_pad(hexdec($strArray[5]), 2, '0', STR_PAD_LEFT).':'. //min
            str_pad(hexdec($strArray[6]), 2, '0', STR_PAD_LEFT) //sec
        ;
        return $ret;
    }
    
    /**
     * Convert SNMP hex IP to decimal
     *
     * @param string $hex
     *
     * @return string
     */
    protected function ipHexToDec($hex)
    {
        $str = $this->removeSpaces($this->trimResponseValue($hex));
        $strArray = str_split($str, 2);
        $ret = hexdec($strArray[0]).'.'.hexdec($strArray[1]).'.'.hexdec($strArray[2]).'.'.hexdec($strArray[3]);
        return $ret;
    }

    /* CISCO-VLAN-MEMBERSHIP : vmMembershipTable */
    
    /**
     * Walk VLAN Port membership table MIB
     *
     * @return array
     */
    public function walkVmMembershipTable()
    {
        $vmMembershipTable = $this->walk('1.3.6.1.4.1.9.9.68.1.2.2.1');
        
        $ret = [];
        foreach ($vmMembershipTable as $oid => $value) {
            $oids = $this->explodeAndReverse($oid);
            $ret[$oids[0]]['ifIndex'] = $oids[0];
            
            switch ($oids[1]) {
                case 1:
                    $ret[$oids[0]]['vmVlanType'] = $this->convertVmVlanType($value);
                    break;
                case 2:
                    $ret[$oids[0]]['vmVlan'] = $value;
                    break;
                case 3:
                    $ret[$oids[0]]['vmPortStatus'] = $this->convertVmPortStatus($value);
                    break;
                default:
                    break;
            }
        }
        return $ret;
    }
    
    /**
     * Walk VLAN
     *
     * @return array key=ifIndex, value=vlanId
     */
    public function walkVmVlan()
    {
        $vmVlan = $this->walk('1.3.6.1.4.1.9.9.68.1.2.2.1.2');
        
        $ret = [];
        foreach ($vmVlan as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }

    /**
     * Convert vmVlanType to readable
     *
     * @param integer $vlanType
     *
     * @return string
     */
    private function convertVmVlanType($vlanType)
    {
        switch ($vlanType) {
            case 1:
                $status = 'static';
                break;
            case 2:
                $status = 'dynamic';
                break;
            case 3:
                $status = 'multiVlan';
                break;
            default:
                $status = $vlanType;
                break;
        }
        return $status;
    }
    
    /**
     * Convert vmPortStatus to readable
     *
     * @param integer $portStatus
     *
     * @return string
     */
    private function convertVmPortStatus($portStatus)
    {
        switch ($portStatus) {
            case 1:
                $status = 'inactive';
                break;
            case 2:
                $status = 'active';
                break;
            case 3:
                $status = 'shutdown';
                break;
            default:
                $status = $portStatus;
                break;
        }
        return $status;
    }

    /* CISCO-VLAN-MEMBERSHIP : vmVoiceVlanTable */
    
    /**
     * Walk Voice VLAN ID
     *
     * @return array key=ifIndex, value=vlanId
     */
    public function walkVmVoiceVlanId()
    {
        $walkVmVoiceVlanId = $this->walk('1.3.6.1.4.1.9.9.68.1.5.1.1.1');
        
        $ret = [];
        foreach ($walkVmVoiceVlanId as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
}
