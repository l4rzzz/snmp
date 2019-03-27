<?php

namespace L4rzzz\Snmp\Enterprise\Cisco;

/**
 * Class to interact with CUCM.
 *
 * @package L4rzzz\Snmp
 */
class Ccm extends \L4rzzz\Snmp\Mgmt\Mib2
{
    /* CISCO-CCM-MIB */

    /**
     * Walk CCM phone MAC adress
     *
     * @return array key=phoneID, value=MAC
     */
    public function walkCcmPhonePhysAddr()
    {
        $ccmPhonePhysicalAddress = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.2');

        $ret = [];
        foreach ($ccmPhonePhysicalAddress as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->removeSpaces($value);
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone descriptions
     *
     * @return array key=phoneID, value=description
     */
    public function walkCcmPhoneDescr()
    {
        $ccmPhoneDescription = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.4');

        $ret = [];
        foreach ($ccmPhoneDescription as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone username
     *
     * @return array key=phoneID, value=username
     */
    public function walkCcmPhoneUserName()
    {
        $ccmPhoneUserName = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.5');

        $ret = [];
        foreach ($ccmPhoneUserName as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone status
     *
     * @return array key=phoneID, value=status
     */
    public function walkCcmPhoneStatus()
    {
        $ccmPhoneStatus = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.7');

        $ret = [];
        foreach ($ccmPhoneStatus as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 1:
                    $status = 'unknown';
                    break;
                case 2:
                    $status = 'registered';
                    break;
                case 3:
                    $status = 'unregistered';
                    break;
                case 4:
                    $status = 'rejected';
                    break;
                case 5:
                    $status = 'partiallyregistered';
                    break;
                default:
                    $status = $value;
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $status;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone last registration
     *
     * @return array key=phoneID, value=date last registered
     */
    public function walkCcmPhoneLastRegistered()
    {
        $ccmPhoneTimeLastRegistered = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.8');

        $ret = [];
        foreach ($ccmPhoneTimeLastRegistered as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->dateHexToDec($value);
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone E911 location
     *
     * @return array key=phoneID, value=location
     */
    public function walkCcmPhoneE911Location()
    {
        $ccmPhoneE911Location = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.9');

        $ret = [];
        foreach ($ccmPhoneE911Location as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone firmware
     *
     * If the phone is successfully upgraded to the new load then
     *  ccmPhoneLoadID and ccmPhoneActiveLoadID will have same value. If
     *  the upgrade fails then the ccmPhoneLoadID has the configured
     *  load ID and ccmPhoneActiveLoadID has the actual load ID that is running on the phone
     *
     * @return array key=phoneID, value=firmware
     */
    public function walkCcmPhoneLoadId()
    {
        $ccmPhoneLoadId = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.10');

        $ret = [];
        foreach ($ccmPhoneLoadId as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone last status update
     *
     * @return array key=phoneID, value=date last update
     */
    public function walkCcmPhoneTimeLastStatusUpdt()
    {
        $ccmPhoneTimeLastStatusUpdt = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.17');

        $ret = [];
        foreach ($ccmPhoneTimeLastStatusUpdt as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->dateHexToDec($value);
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone protocol
     *
     * @return array key=phoneID, value=protocol
     */
    public function walkCcmPhoneProtocol()
    {
        $ccmPhoneProtocol = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.19');

        $ret = [];
        foreach ($ccmPhoneProtocol as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 1:
                    $protocol = 'unknown';
                    break;
                case 2:
                    $protocol = 'sccp';
                    break;
                case 3:
                    $protocol = 'sip';
                    break;
                default:
                    $protocol = $value;
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $protocol;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone name
     *
     * @return array key=phoneID, value=name
     */
    public function walkCcmPhoneName()
    {
        $ccmPhoneName = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.20');

        $ret = [];
        foreach ($ccmPhoneName as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone IPv4
     *
     * @return array key=phoneID, value=IPv4
     */
    public function walkCcmPhoneIPv4()
    {
        $walkCcmPhoneIPv4 = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.21');

        $ret = [];
        foreach ($walkCcmPhoneIPv4 as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $this->ipHexToDec($value);
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone IPv4 attribute
     *
     * @return array key=phoneID, value=attribute
     */
    public function walkCcmPhoneIPv4Attr()
    {
        $ccmPhoneIPv4Attr = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.23');

        $ret = [];
        foreach ($ccmPhoneIPv4Attr as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 0:
                    $attr = 'unknown';
                    break;
                case 1:
                    $attr = 'adminOnly';
                    break;
                case 2:
                    $attr = 'controlOnly';
                    break;
                case 3:
                    $attr = 'adminAndControl';
                    break;
                default:
                    $attr = $value;
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $attr;
        }
        return $ret;
    }
    
    /**
     * Walk CCM phone active firmware
     *
     * If the phone is successfully upgraded to the new load then
     *  ccmPhoneLoadID and ccmPhoneActiveLoadID will have same value. If
     *  the upgrade fails then the ccmPhoneLoadID has the configured
     *  load ID and ccmPhoneActiveLoadID has the actual load ID that is running on the phone
     *
     * @return array key=phoneID, value=status
     */
    public function walkCcmPhoneActiveLoadId()
    {
        $ccmPhoneActiveLoadId = $this->walk('1.3.6.1.4.1.9.9.156.1.2.1.1.25');

        $ret = [];
        foreach ($ccmPhoneActiveLoadId as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
}
