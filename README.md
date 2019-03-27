# L4rzzz\Snmp

PHP Component to interact with network connected devices via SNMP

----

### Classes and associated MIBs 

- __L4rzzz\Snmp\Snmp__  
  This class has 3 public methods where you can pass OIDs to interact with devices. The other classes extend it and use preset methods for specific MIBs.
  
- __L4rzzz\Snmp\Mgmt\Mib2__  
    - BRIDGE-MIB
    - ENTITY-MIB
    - IF-MIB
    - IP-MIB
    - SNMPv2-SMI
  
- __L4rzzz\Snmp\Enterprise\Cisco\Cisco__  
    Extends ``L4rzzz\Snmp\Mgmt\Mib2`` to use MIBs from the MIB-2 tree.
    - CISCO-VTP-MIB
    - CISCO-VLAN-MEMBERSHIP
  
- __L4rzzz\Snmp\Enterprise\Cisco\Ccm__  
    Extends ``L4rzzz\Snmp\Mgmt\Mib2`` to use MIBs from the MIB-2 tree.
    - CISCO-CCM-MIB
  
- __L4rzzz\Snmp\Enterprise\Infoblox\Infoblox__  
    Extends ``L4rzzz\Snmp\Mgmt\Mib2`` to use MIBs from the MIB-2 tree.
    - IB-DNSONE-MIB
    - IB-DHCPONE-MIB
  
----

### Usage  

- Examples  

__SNMPv2c with custom OID__  

```php
<?php
use \L4rzzz\Snmp\Snmp;

$auth = ['ro' => 'public'];
$s = new Snmp('10.10.10.10', $auth, 'v2c');

print $s->walk('1.3.6.1.2.1.1.1');
```  

__SNMPv3 with MIB-2 methods__  

```php
<?php
use \L4rzzz\Snmp\Mgmt\Mib2;

$auth = [
    'securityName' => 'foo',
    'securityLevel' => 'AuthPriv',
    'authProtocol' => 'md5',
    'authKey' => 'bar',
    'privProtocol' => 'des',
    'privKey' => 'foobar',
];
$s = new Mib2('10.10.10.10', $auth, 'v3');

print $s->walkIfName();
```  

__SNMPv2c with Cisco methods__  

```php
<?php
use \L4rzzz\Snmp\Enterprise\Cisco\Cisco;

$auth = ['ro' => 'public'];
$s = new Cisco('10.10.10.10', $auth, 'v2c');

print $s->walkVtpVlanName();

//Cisco extends Mib2, Mib2 extends Snmp
//So you can use these methods on Cisco objects too
print $s->walk('1.3.6.1.2.1.1.1');
print $s->walkEntPhysicalDescr();
```  
