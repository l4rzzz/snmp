<?php

namespace L4rzzz\Snmp\Mgmt;

/**
 * Class to interact with MIBs down the MIB-2 tree.
 *
 * @package L4rzzz\Snmp
 */
class Mib2 extends \L4rzzz\Snmp\Snmp
{
    /* SNMPv2-SMI : system */
    
    /**
     * Get system description
     *
     * @return string
     */
    public function getSysDescr()
    {
        return $this->get('1.3.6.1.2.1.1.1.0');
    }
    
    /**
     * Get system uptime
     *
     * @return string
     */
    public function getSysUptime()
    {
        return $this->get('1.3.6.1.2.1.1.3.0');
    }
    
    /**
     * Get system contact
     *
     * @return string
     */
    public function getSysContact()
    {
        return $this->get('1.3.6.1.2.1.1.4.0');
    }
    
    /**
     * Get system name
     *
     * @return string
     */
    public function getSysName()
    {
        return $this->get('1.3.6.1.2.1.1.5.0');
    }
    
    /**
     * Get system location
     *
     * @return string
     */
    public function getSysLocation()
    {
        return $this->get('1.3.6.1.2.1.1.6.0');
    }
    
    /* IF-MIB : ifTable */
    
    /**
     * Walk interface description
     *
     * @return array
     */
    public function walkIfDescr()
    {
        $ifDescr = $this->walk('1.3.6.1.2.1.2.2.1.2');

        $ret = [];
        foreach ($ifDescr as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk interface types
     *
     * @return array
     */
    public function walkIfType()
    {
        $ifType = $this->walk('1.3.6.1.2.1.2.2.1.3');

        $ret = [];
        foreach ($ifType as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 1:
                    $type = 'other';
                    break;
                case 2:
                    $type = 'regular1822';
                    break;
                case 3:
                    $type = 'hdh1822';
                    break;
                case 4:
                    $type = 'ddnX25';
                    break;
                case 5:
                    $type = 'rfc877x25';
                    break;
                case 6:
                    $type = 'ethernetCsmacd';
                    break;
                case 7:
                    $type = 'iso88023Csmacd';
                    break;
                case 8:
                    $type = 'iso88024TokenBus';
                    break;
                case 9:
                    $type = 'iso88025TokenRing';
                    break;
                case 10:
                    $type = 'iso88026Man';
                    break;
                case 11:
                    $type = 'starLan';
                    break;
                case 12:
                    $type = 'proteon10Mbit';
                    break;
                case 13:
                    $type = 'proteon80Mbit';
                    break;
                case 14:
                    $type = 'hyperchannel';
                    break;
                case 15:
                    $type = 'fddi';
                    break;
                case 16:
                    $type = 'lapb';
                    break;
                case 17:
                    $type = 'sdlc';
                    break;
                case 18:
                    $type = 'ds1';
                    break;
                case 19:
                    $type = 'e1';
                    break;
                case 20:
                    $type = 'basicISDN';
                    break;
                case 21:
                    $type = 'primaryISDN';
                    break;
                case 22:
                    $type = 'propPointToPointSerial';
                    break;
                case 23:
                    $type = 'ppp';
                    break;
                case 24:
                    $type = 'softwareLoopback';
                    break;
                case 25:
                    $type = 'eon';
                    break;
                case 26:
                    $type = 'ethernet3Mbit';
                    break;
                case 27:
                    $type = 'nsip';
                    break;
                case 28:
                    $type = 'slip';
                    break;
                case 29:
                    $type = 'ultra';
                    break;
                case 30:
                    $type = 'ds3';
                    break;
                case 31:
                    $type = 'sip';
                    break;
                case 32:
                    $type = 'frameRelay';
                    break;
                case 33:
                    $type = 'rs232';
                    break;
                case 34:
                    $type = 'para';
                    break;
                case 35:
                    $type = 'arcnet';
                    break;
                case 36:
                    $type = 'arcnetPlus';
                    break;
                case 37:
                    $type = 'atm';
                    break;
                case 38:
                    $type = 'miox25';
                    break;
                case 39:
                    $type = 'sonet';
                    break;
                case 40:
                    $type = 'x25ple';
                    break;
                case 41:
                    $type = 'iso88022llc';
                    break;
                case 42:
                    $type = 'localTalk';
                    break;
                case 43:
                    $type = 'smdsDxi';
                    break;
                case 44:
                    $type = 'frameRelayService';
                    break;
                case 45:
                    $type = 'v35';
                    break;
                case 46:
                    $type = 'hssi';
                    break;
                case 47:
                    $type = 'hippi';
                    break;
                case 48:
                    $type = 'modem';
                    break;
                case 49:
                    $type = 'aal5';
                    break;
                case 50:
                    $type = 'sonetPath';
                    break;
                case 51:
                    $type = 'sonetVT';
                    break;
                case 52:
                    $type = 'smdsIcip';
                    break;
                case 53:
                    $type = 'propVirtual';
                    break;
                case 54:
                    $type = 'propMultiplexor';
                    break;
                case 55:
                    $type = 'ieee80212';
                    break;
                case 56:
                    $type = 'fibreChannel';
                    break;
                case 57:
                    $type = 'hippiInterface';
                    break;
                case 58:
                    $type = 'frameRelayInterconnect';
                    break;
                case 59:
                    $type = 'aflane8023';
                    break;
                case 60:
                    $type = 'aflane8025';
                    break;
                case 61:
                    $type = 'cctEmul';
                    break;
                case 62:
                    $type = 'fastEther';
                    break;
                case 63:
                    $type = 'isdn';
                    break;
                case 64:
                    $type = 'v11';
                    break;
                case 65:
                    $type = 'v36';
                    break;
                case 66:
                    $type = 'g703at64k';
                    break;
                case 67:
                    $type = 'g703at2mb';
                    break;
                case 68:
                    $type = 'qllc';
                    break;
                case 69:
                    $type = 'fastEtherFX';
                    break;
                case 70:
                    $type = 'channel';
                    break;
                case 71:
                    $type = 'ieee80211';
                    break;
                case 72:
                    $type = 'ibm370parChan';
                    break;
                case 73:
                    $type = 'escon';
                    break;
                case 74:
                    $type = 'dlsw';
                    break;
                case 75:
                    $type = 'isdns';
                    break;
                case 76:
                    $type = 'isdnu';
                    break;
                case 77:
                    $type = 'lapd';
                    break;
                case 78:
                    $type = 'ipSwitch';
                    break;
                case 79:
                    $type = 'rsrb';
                    break;
                case 80:
                    $type = 'atmLogical';
                    break;
                case 81:
                    $type = 'ds0';
                    break;
                case 82:
                    $type = 'ds0Bundle';
                    break;
                case 83:
                    $type = 'bsc';
                    break;
                case 84:
                    $type = 'async';
                    break;
                case 85:
                    $type = 'cnr';
                    break;
                case 86:
                    $type = 'iso88025Dtr';
                    break;
                case 87:
                    $type = 'eplrs';
                    break;
                case 88:
                    $type = 'arap';
                    break;
                case 89:
                    $type = 'propCnls';
                    break;
                case 90:
                    $type = 'hostPad';
                    break;
                case 91:
                    $type = 'termPad';
                    break;
                case 92:
                    $type = 'frameRelayMPI';
                    break;
                case 93:
                    $type = 'x213';
                    break;
                case 94:
                    $type = 'adsl';
                    break;
                case 95:
                    $type = 'radsl';
                    break;
                case 96:
                    $type = 'sdsl';
                    break;
                case 97:
                    $type = 'vdsl';
                    break;
                case 98:
                    $type = 'iso88025CRFPInt';
                    break;
                case 99:
                    $type = 'myrinet';
                    break;
                case 100:
                    $type = 'voiceEM';
                    break;
                case 101:
                    $type = 'voiceFXO';
                    break;
                case 102:
                    $type = 'voiceFXS';
                    break;
                case 103:
                    $type = 'voiceEncap';
                    break;
                case 104:
                    $type = 'voiceOverIp';
                    break;
                case 105:
                    $type = 'atmDxi';
                    break;
                case 106:
                    $type = 'atmFuni';
                    break;
                case 107:
                    $type = 'atmIma';
                    break;
                case 108:
                    $type = 'pppMultilinkBundle';
                    break;
                case 109:
                    $type = 'ipOverCdlc';
                    break;
                case 110:
                    $type = 'ipOverClaw';
                    break;
                case 111:
                    $type = 'stackToStack';
                    break;
                case 112:
                    $type = 'virtualIpAddress';
                    break;
                case 113:
                    $type = 'mpc';
                    break;
                case 114:
                    $type = 'ipOverAtm';
                    break;
                case 115:
                    $type = 'iso88025Fiber';
                    break;
                case 116:
                    $type = 'tdlc';
                    break;
                case 117:
                    $type = 'gigabitEthernet';
                    break;
                case 118:
                    $type = 'hdlc';
                    break;
                case 119:
                    $type = 'lapf';
                    break;
                case 120:
                    $type = 'v37';
                    break;
                case 121:
                    $type = 'x25mlp';
                    break;
                case 122:
                    $type = 'x25huntGroup';
                    break;
                case 123:
                    $type = 'trasnpHdlc';
                    break;
                case 124:
                    $type = 'interleave';
                    break;
                case 125:
                    $type = 'fast';
                    break;
                case 126:
                    $type = 'ip';
                    break;
                case 127:
                    $type = 'docsCableMaclayer';
                    break;
                case 128:
                    $type = 'docsCableDownstream';
                    break;
                case 129:
                    $type = 'docsCableUpstream';
                    break;
                case 130:
                    $type = 'a12MppSwitch';
                    break;
                case 131:
                    $type = 'tunnel';
                    break;
                case 132:
                    $type = 'coffee';
                    break;
                case 133:
                    $type = 'ces';
                    break;
                case 134:
                    $type = 'atmSubInterface';
                    break;
                case 135:
                    $type = 'l2vlan';
                    break;
                case 136:
                    $type = 'l3ipvlan';
                    break;
                case 137:
                    $type = 'l3ipxvlan';
                    break;
                case 138:
                    $type = 'digitalPowerline';
                    break;
                case 139:
                    $type = 'mediaMailOverIp';
                    break;
                case 140:
                    $type = 'dtm';
                    break;
                case 141:
                    $type = 'dcn';
                    break;
                case 142:
                    $type = 'ipForward';
                    break;
                case 143:
                    $type = 'msdsl';
                    break;
                case 144:
                    $type = 'ieee1394';
                    break;
                case 145:
                    $type = 'if-gsn';
                    break;
                case 146:
                    $type = 'dvbRccMacLayer';
                    break;
                case 147:
                    $type = 'dvbRccDownstream';
                    break;
                case 148:
                    $type = 'dvbRccUpstream';
                    break;
                case 149:
                    $type = 'atmVirtual';
                    break;
                case 150:
                    $type = 'mplsTunnel';
                    break;
                case 151:
                    $type = 'srp';
                    break;
                case 152:
                    $type = 'voiceOverAtm';
                    break;
                case 153:
                    $type = 'voiceOverFrameRelay';
                    break;
                case 154:
                    $type = 'idsl';
                    break;
                case 155:
                    $type = 'compositeLink';
                    break;
                case 156:
                    $type = 'ss7SigLink';
                    break;
                case 157:
                    $type = 'propWirelessP2P';
                    break;
                case 158:
                    $type = 'frForward';
                    break;
                case 159:
                    $type = 'rfc1483';
                    break;
                case 160:
                    $type = 'usb';
                    break;
                case 161:
                    $type = 'ieee8023adLag';
                    break;
                case 162:
                    $type = 'bgppolicyaccounting';
                    break;
                case 163:
                    $type = 'frf16MfrBundle';
                    break;
                case 164:
                    $type = 'h323Gatekeeper';
                    break;
                case 165:
                    $type = 'h323Proxy';
                    break;
                case 166:
                    $type = 'mpls';
                    break;
                case 167:
                    $type = 'mfSigLink';
                    break;
                case 168:
                    $type = 'hdsl2';
                    break;
                case 169:
                    $type = 'shdsl';
                    break;
                case 170:
                    $type = 'ds1FDL';
                    break;
                case 171:
                    $type = 'pos';
                    break;
                case 172:
                    $type = 'dvbAsiIn';
                    break;
                case 173:
                    $type = 'dvbAsiOut';
                    break;
                case 174:
                    $type = 'plc';
                    break;
                case 175:
                    $type = 'nfas';
                    break;
                case 176:
                    $type = 'tr008';
                    break;
                case 177:
                    $type = 'gr303RDT';
                    break;
                case 178:
                    $type = 'gr303IDT';
                    break;
                case 179:
                    $type = 'isup';
                    break;
                case 180:
                    $type = 'propDocsWirelessMaclayer';
                    break;
                case 181:
                    $type = 'propDocsWirelessDownstream';
                    break;
                case 182:
                    $type = 'propDocsWirelessUpstream';
                    break;
                case 183:
                    $type = 'hiperlan2';
                    break;
                case 184:
                    $type = 'propBWAp2Mp';
                    break;
                case 185:
                    $type = 'sonetOverheadChannel';
                    break;
                case 186:
                    $type = 'digitalWrapperOverheadChannel';
                    break;
                case 187:
                    $type = 'aal2';
                    break;
                case 188:
                    $type = 'radioMAC';
                    break;
                case 189:
                    $type = 'atmRadio';
                    break;
                case 190:
                    $type = 'imt';
                    break;
                case 191:
                    $type = 'mvl';
                    break;
                case 192:
                    $type = 'reachDSL';
                    break;
                case 193:
                    $type = 'frDlciEndPt';
                    break;
                case 194:
                    $type = 'atmVciEndPt';
                    break;
                case 195:
                    $type = 'opticalChannel';
                    break;
                case 196:
                    $type = 'opticalTransport';
                    break;
                case 197:
                    $type = 'propAtm';
                    break;
                case 198:
                    $type = 'voiceOverCable';
                    break;
                case 199:
                    $type = 'infiniband';
                    break;
                case 200:
                    $type = 'teLink';
                    break;
                case 201:
                    $type = 'q2931';
                    break;
                case 202:
                    $type = 'virtualTg';
                    break;
                case 203:
                    $type = 'sipTg';
                    break;
                case 204:
                    $type = 'sipSig';
                    break;
                case 205:
                    $type = 'docsCableUpstreamChannel';
                    break;
                case 206:
                    $type = 'econet';
                    break;
                case 207:
                    $type = 'pon155';
                    break;
                case 208:
                    $type = 'pon622';
                    break;
                case 209:
                    $type = 'bridge';
                    break;
                case 210:
                    $type = 'linegroup';
                    break;
                case 211:
                    $type = 'voiceEMFGD';
                    break;
                case 212:
                    $type = 'voiceFGDEANA';
                    break;
                case 213:
                    $type = 'voiceDID';
                    break;
                case 214:
                    $type = 'mpegTransport';
                    break;
                case 215:
                    $type = 'sixToFour';
                    break;
                case 216:
                    $type = 'gtp';
                    break;
                case 217:
                    $type = 'pdnEtherLoop1';
                    break;
                case 218:
                    $type = 'pdnEtherLoop2';
                    break;
                case 219:
                    $type = 'opticalChannelGroup';
                    break;
                case 220:
                    $type = 'homepna';
                    break;
                case 221:
                    $type = 'gfp';
                    break;
                case 222:
                    $type = 'ciscoISLvlan';
                    break;
                case 223:
                    $type = 'actelisMetaLOOP';
                    break;
                case 224:
                    $type = 'fcipLink';
                    break;
                case 225:
                    $type = 'rpr';
                    break;
                case 226:
                    $type = 'qam';
                    break;
                case 227:
                    $type = 'lmp';
                    break;
                case 228:
                    $type = 'cblVectaStar';
                    break;
                case 229:
                    $type = 'docsCableMCmtsDownstream';
                    break;
                case 230:
                    $type = 'adsl2';
                    break;
                case 231:
                    $type = 'macSecControlledIF';
                    break;
                case 232:
                    $type = 'macSecUncontrolledIF';
                    break;
                case 233:
                    $type = 'aviciOpticalEther';
                    break;
                case 234:
                    $type = 'atmbond';
                    break;
                default:
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $type;
        }
        return $ret;
    }
    
    /**
     * Walk interface MTU
     *
     * @return array
     */
    public function walkIfMtu()
    {
        $ifMtu = $this->walk('1.3.6.1.2.1.2.2.1.4');

        $ret = [];
        foreach ($ifMtu as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk interface speed
     *
     * @return array
     */
    public function walkIfSpeed()
    {
        $ifSpeed = $this->walk('1.3.6.1.2.1.2.2.1.5');

        $ret = [];
        foreach ($ifSpeed as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk interface MAC addr
     *
     * @return array
     */
    public function walkIfPhysAddr()
    {
        $ifPhysAddress = $this->walk('1.3.6.1.2.1.2.2.1.6');

        $ret = [];
        foreach ($ifPhysAddress as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk interface administrative status
     *
     * @return array
     */
    public function walkIfAdminStatus()
    {
        $ifAdminStatus = $this->walk('1.3.6.1.2.1.2.2.1.7');

        $ret = [];
        foreach ($ifAdminStatus as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 1:
                    $status = 'up';
                    break;
                case 2:
                    $status = 'down';
                    break;
                case 3:
                    $status = 'testing';
                    break;
                default:
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $status;
        }
        return $ret;
    }
    
    /**
     * Walk interface operational status
     *
     * @return array
     */
    public function walkIfOperStatus()
    {
        $ifOperStatus = $this->walk('1.3.6.1.2.1.2.2.1.8');

        $ret = [];
        foreach ($ifOperStatus as $oid => $value) {
            switch ($this->trimResponseValue($value)) {
                case 1:
                    $status = 'up';
                    break;
                case 2:
                    $status = 'down';
                    break;
                case 3:
                    $status = 'testing';
                    break;
                case 4:
                    $status = 'unknown';
                    break;
                case 5:
                    $status = 'dormant';
                    break;
                case 6:
                    $status = 'notPresent';
                    break;
                case 7:
                    $status = 'lowerLayerDown';
                    break;
                default:
                    break;
            }
            $ret[$this->getLastOidDigit($oid)] = $status;
        }
        return $ret;
    }
    
    /**
     * Walk interface last change
     *
     * @return array
     */
    public function walkIfLastChange()
    {
        $ifLastChange = $this->walk('1.3.6.1.2.1.2.2.1.9');

        $ret = [];
        foreach ($ifLastChange as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk interface in octets
     *
     * @return array
     */
    public function walkIfInOctets()
    {
        $ifInOctets = $this->walk('1.3.6.1.2.1.2.2.1.10');

        $ret = [];
        foreach ($ifInOctets as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /* IF-MIB : ifXTable */

    /**
     * Walk Interface Name
     *
     * @return array
     */
    public function walkIfName()
    {
        $ifName = $this->walk('1.3.6.1.2.1.31.1.1.1.1');

        $ret = [];
        foreach ($ifName as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Walk Interface Alias
     *
     * @return array
     */
    public function walkIfAlias()
    {
        $ifAlias = $this->walk('1.3.6.1.2.1.31.1.1.1.18');

        $ret = [];
        foreach ($ifAlias as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /* ENTITY-MIB : entPhysicalTable*/
    
    /**
     * Walk physical entity table MIB
     *
     * @return array key=entId, value = array('descr' => '', 'name' => '', etc...)
     */
    public function walkEntPhysicalTable()
    {
        $entPhysicalEntry = $this->walk('1.3.6.1.2.1.47.1.1.1.1');

        $ret = [];
        foreach ($entPhysicalEntry as $oid => $value) {
            $oids = $this->getLastTwoOidDigit($oid);
            $ret[$oids[0]]['id'] = $oids[0];
            
            switch ($oids[1]) {
                case 2:
                    $ret[$oids[0]]['descr'] = $value;
                    break;
                case 3:
                    $ret[$oids[0]]['vendorType'] = $value;
                    break;
                case 4:
                    $ret[$oids[0]]['containedIn'] = $value;
                    break;
                case 5:
                    $ret[$oids[0]]['class'] = $this->convertPhysicalClass($value);
                    break;
                case 6:
                    $ret[$oids[0]]['parentRelPos'] = $value;
                    break;
                case 7:
                    $ret[$oids[0]]['name'] = $value;
                    break;
                case 8:
                    $ret[$oids[0]]['hardwareRev'] = $value;
                    break;
                case 9:
                    $ret[$oids[0]]['firmwareRev'] = $value;
                    break;
                case 10:
                    $ret[$oids[0]]['softwareRev'] = $value;
                    break;
                case 11:
                    $ret[$oids[0]]['serialNum'] = $value;
                    break;
                case 12:
                    $ret[$oids[0]]['mfgName'] = $value;
                    break;
                case 13:
                    $ret[$oids[0]]['modelName'] = $value;
                    break;
                case 14:
                    $ret[$oids[0]]['alias'] = $value;
                    break;
                case 15:
                    $ret[$oids[0]]['assetId'] = $value;
                    break;
                case 16:
                    $ret[$oids[0]]['fru'] = $value;
                    break;
                case 17:
                    $ret[$oids[0]]['mfgDate'] = $value;
                    break;
                case 18:
                    $ret[$oids[0]]['uris'] = $value;
                    break;
                default:
                    break;
            }
        }
        return $ret;
    }
    
    /**
     * Walk physical entity description
     *
     * @return array key=index, value=descr
     */
    public function walkEntPhysicalDescr()
    {
        $entPhysicalDescr = $this->walk('1.3.6.1.2.1.47.1.1.1.1.2');
            
        $ret = [];
        foreach ($entPhysicalDescr as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }
    
    /**
     * Convert physicalClass to readable
     *
     * @param integer $class
     *
     * @return string
     */
    protected function convertPhysicalClass($class)
    {
        switch ($class) {
            case 1:
                return 'other';
                break;
            case 2:
                return 'unknown';
                break;
            case 3:
                return 'chassis';
                break;
            case 4:
                return 'backplane';
                break;
            case 5:
                return 'container';
                break;
            case 6:
                return 'powerSupply';
                break;
            case 7:
                return 'fan';
                break;
            case 8:
                return 'sensor';
                break;
            case 9:
                return 'module';
                break;
            case 10:
                return 'port';
                break;
            case 11:
                return 'stack';
                break;
            case 12:
                return 'cpu';
                break;
            default:
                return $class;
        }
    }
    
    /* ENTITY-MIB : entLogicalTable */
    
    /**
     * Walk Entity Logical Community
     *
     * @return array key=id, value='public@1'
     */
    public function walkEntLogicalCommunity()
    {
        $entLogicalCommunity = $this->walk('1.3.6.1.2.1.47.1.2.1.1.4');
        
        $ret = [];
        foreach ($entLogicalCommunity as $oid => $value) {
            $ret[$this->getLastOidDigit($oid)] = $value;
        }
        return $ret;
    }

    /* IP-MIB : ipNetToMediaTable */
    
    /**
     * Walk IP Net to Media Table MIB.
     *
     * Used for ARP. Deprecated OID.
     * Warning: CPU Killer on our C6509s.
     *
     * @return array
     */
    public function walkIpNetToMediaTable()
    {
        $ipNetToMediaTable = $this->walk('1.3.6.1.2.1.4.22.1');
        $ret = [];
        foreach ($ipNetToMediaTable as $oid => $value) {
            $oids = $this->explodeAndReverse($oid);
            $oidIp = $oids[3].'.'.$oids[2].'.'.$oids[1].'.'.$oids[0];
            
            switch ($oids[5]) {
                case 1:
                    $ret[$oidIp]['ipNetToMediaIfIndex'] = $value;
                    break;
                case 2:
                    $ret[$oidIp]['ipNetToMediaPhysAddress'] = $this->removeSpaces($value);
                    break;
                case 3:
                    $ret[$oidIp]['ipNetToMediaNetAddress'] = $value;
                    break;
                case 4:
                    $value = str_replace(array(1,2,3,4), array('other', 'invalid', 'dynamic', 'static'), $value);
                    $ret[$oidIp]['ipNetToMediaType'] = $value;
                    break;
                default:
                    break;
            }
        }
        return $ret;
    }
    
    /**
     * Walk IP Net to Media Physical Address
     *
     * Used for ARP. Deprecated OID.
     *
     * @return array key=ip, value=mac
     */
    public function walkIpNetToMediaPhysAddress()
    {
        $ipNetToMediaPhysAddress = $this->walk('1.3.6.1.2.1.4.22.1.2');
        
        $ret = [];
        foreach ($ipNetToMediaPhysAddress as $oid => $value) {
            $oids = $this->explodeAndReverse($oid);
            $ret[$oids[3].'.'.$oids[2].'.'.$oids[1].'.'.$oids[0]] = $this->removeSpaces($value);
        }
        return $ret;
    }

    /* BRIDGE-MIB :  dot1dTpFdbTable */
    
    /**
     * Walk Unicast MAC address
     *
     * SNMPv2c: creates a tmp object to set community@vlan as 'ro'.
     * SMMPv3: Not supported. Requires SNMP contexts on equipments to poll multiple VLANs. Will return MACs on VLAN1
     *
     * @param string $communityAtVlan SNMPv2c only. Pass a community@vlan string to fetch the MAC from a specific VLAN
     *
     * @return array key=ifIndex, value=mac addr
     */
    public function walkDot1dTpFdbTable($communityAtVlan = null)
    {
        $tmpRet = [];
        if ($this->version == 'v3') {
            $walkDot1dTpFdbTable = $this->walk('1.3.6.1.2.1.17.4.3.1');
        
            foreach ($walkDot1dTpFdbTable as $oid => $value) {
                $tmpRet[$oid] = $this->removeSpaces($value);
            }
        } elseif ($this->version == 'v2c') {
            if ($communityAtVlan == null) { // use auth ro value
                $walkDot1dTpFdbTable = $this->walk('1.3.6.1.2.1.17.4.3.1');
            } else { // use $communityAtVlan as auth ro to walk a specific VLAN
                $auth = array('ro' => $communityAtVlan);
                $s = new self($this->host, $auth, $this->version, $this->timeout, $this->retries, $this->trimResponse);
                $walkDot1dTpFdbTable = $s->walk('1.3.6.1.2.1.17.4.3.1');
                unset($s);
            }
            $tmpRet = [];
            foreach ($walkDot1dTpFdbTable as $oid => $value) {
                $tmpRet[$oid] = $this->removeSpaces($value);
            }
        }

        // return array construction
        // following messy code is because I wanted to only use 1 SNMP request to map ifIndex to MAC
        $retTmp2 = [];
        $ret = [];
        foreach ($tmpRet as $oid => $value) {
            $lastOid=$this->getLastOidDigit($oid);
            if (strpos($oid, '17.4.3.1.1') !== false) { // if dot1dTpFdbAddress
                $retTmp2[$lastOid]['port'] = $lastOid;
                $retTmp2[$lastOid]['mac'] = $value;
            } elseif (strpos($oid, '17.4.3.1.2') !== false) { // if dot1dTpFdbPort
                foreach ($retTmp2 as $arr) {
                    if ($arr['port'] == $lastOid) {
                        $ret[$value] = $arr['mac'];
                    }
                }
            }
        }
        return $ret;
    }
}
