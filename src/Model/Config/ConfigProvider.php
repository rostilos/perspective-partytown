<?php

namespace Perspective\Partytown\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Perspective\Partytown\Api\Config\ConfigProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
    )
    {
    }

    public function isModuleEnabled(): bool
    {
        $isEnabled = $this->scopeConfig->getValue(self::PARTYTOWN_IS_ENABLED, ScopeInterface::SCOPE_STORE);
        return $isEnabled;
    }

    public function getLoadViaMainThreadList(): mixed
    {
        $isEnabled = $this->scopeConfig->getValue(self::LOAD_IN_MAIN_THREAD_LIST, ScopeInterface::SCOPE_STORE);
        return $isEnabled;
    }


    public function isDebugEnabled(): bool
    {
        $isEnabled = $this->scopeConfig->getValue(self::DEBUG_IS_ENABLED, ScopeInterface::SCOPE_STORE);
        return $isEnabled;
    }

    public function getForwardingEventsList(): mixed
    {
        $cookieText = $this->scopeConfig->getValue(self::FORWARDING_EVENTS_LIST, ScopeInterface::SCOPE_STORE);
        return $cookieText;
    }

    public function isProxyingRequestsEnabled(): bool
    {
        return $this->scopeConfig->getValue(self::PROXYING_REQUESTS_IS_ENABLED, ScopeInterface::SCOPE_STORE);
    }


    public function getProxyingRequestList(): mixed
    {
        return $this->scopeConfig->getValue(self::PROXYING_REQUESTS_LIST, ScopeInterface::SCOPE_STORE);
    }

    public function getProxyUrl(): ?string
    {
        return $this->scopeConfig->getValue(self::PROXY_URL, ScopeInterface::SCOPE_STORE);
    }


    public function getDebugConfigsList(): mixed
    {
        return $this->scopeConfig->getValue(self::DEBUG_LOGGING_LIST, ScopeInterface::SCOPE_STORE);
    }

}
