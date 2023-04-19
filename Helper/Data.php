<?php

namespace Perspective\Partytown\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /* General Configuration*/
    const PARTYTOWN_IS_ENABLED = 'perspective/settings/status';
    const LOAD_IN_MAIN_THREAD_LIST = 'perspective/settings/load_in_main_list';

    /* Forwarding Events*/
    const FORWARDING_EVENTS_LIST = 'perspective/settings/forwarding_events_list';

    /* Proxying Requests */
    const PROXYING_REQUESTS_IS_ENABLED = 'perspective/settings/proxying_requests_status';
    const PROXYING_REQUESTS_LIST = 'perspective/settings/proxying_requests_domains';
    const PROXY_URL = 'perspective/settings/proxy_url';

    /* Logging */
    const DEBUG_IS_ENABLED = 'perspective/settings/debug_status';
    const DEBUG_LOGGING_LIST = 'perspective/settings/debug_logging_list';


    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $isEnabled = $this->scopeConfig->getValue(self::PARTYTOWN_IS_ENABLED, $storeScope);
        return $isEnabled;
    }

    /**
     * @return mixed
     */
    public function getLoadViaMainThreadList()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $isEnabled = $this->scopeConfig->getValue(self::LOAD_IN_MAIN_THREAD_LIST, $storeScope);
        return $isEnabled;
    }

    /**
     * @return mixed
     */
    public function isDebugEnabled()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $isEnabled = $this->scopeConfig->getValue(self::DEBUG_IS_ENABLED, $storeScope);
        return $isEnabled;
    }

    /**
     * @return mixed
     */
    public function getForwardingEventsList()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $cookieText = $this->scopeConfig->getValue(self::FORWARDING_EVENTS_LIST, $storeScope);
        return $cookieText;
    }

    /**
     * @return mixed
     */
    public function isProxyingRequestsEnabled()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $cookieMoreinfoLink = $this->scopeConfig->getValue(self::PROXYING_REQUESTS_IS_ENABLED, $storeScope);
        return $cookieMoreinfoLink;
    }

    /**
     * @return mixed
     */
    public function getProxyingRequestList()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $cookieMoreinfoText = $this->scopeConfig->getValue(self::PROXYING_REQUESTS_LIST, $storeScope);
        return $cookieMoreinfoText;
    }

    /**
     * @return mixed
     */
    public function getProxyUrl()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $cookieMoreinfoText = $this->scopeConfig->getValue(self::PROXY_URL, $storeScope);
        return $cookieMoreinfoText;
    }

    /**
     * @return mixed
     */
    public function getDebugConfigsList()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $cookieText = $this->scopeConfig->getValue(self::DEBUG_LOGGING_LIST, $storeScope);
        return $cookieText;
    }
}