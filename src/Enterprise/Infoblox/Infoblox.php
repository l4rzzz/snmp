<?php

namespace L4rzzz\Snmp\Enterprise\Infoblox;

/**
 * Class to interact with Infoblox.
 *
 * @package L4rzzz\Snmp
 */
class Infoblox extends \L4rzzz\Snmp\Mgmt\Mib2
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
     * @return \L4rzzz\Snmp\Enterprise\Infoblox
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

    /**
     * Get DNS cache hit ratio
     *
     * @return integer    cache hit ratio (%)
     */
    public function getDnsCacheHitRatio()
    {
        $dnsHitRatio = $this->get('1.3.6.1.4.1.7779.3.1.1.3.1.5.0');

        return $dnsHitRatio;
    }

    /* IB-DNSQUERYRATE-MIB */

    /**
     * Get DNS query rate
     *
     * @return integer  query rate (queries/second)
     */
    public function getDnsQueryRate()
    {
        $dnsQueryRate = $this->get('1.3.6.1.4.1.7779.3.1.1.3.1.6.0');

        return $dnsQueryRate;
    }

    /* MIB IB-DNSONE-MIB */

    /**
     * Walk plus view statistics table
     *
     * @return array    plus view statistics table
     */
    public function walkDnsPlusViewStatisticsEntry()
    {
        $plusViewStastisticsEntry = $this->walk('1.3.6.1.4.1.7779.3.1.1.3.1.2.1');

        return $plusViewStastisticsEntry;
    }

    /* IB-DHCPONE-MIB */

    public function walkDhcpSubnetEntry()
    {
        $dhcpSubnetEntry = $this->walk('1.3.6.1.4.1.7779.3.1.1.4.1.1.1');

        return $dhcpSubnetEntry;
    }
}
