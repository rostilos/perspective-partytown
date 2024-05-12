<?php

namespace Perspective\Partytown\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Perspective\Partytown\Api\Config\ConfigProviderInterface;

/**
 * Class Partytown
 *
 * @package Perspective\Partytown\Block
 */
class Config extends Template
{
    protected ConfigProviderInterface $configProvider;

    /**
     *
     * @param ConfigProviderInterface $configProvider
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ConfigProviderInterface $configProvider,
        Context                 $context,
        array                   $data = []
    )
    {
        $this->configProvider = $configProvider;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->configProvider->isModuleEnabled();
    }

    /**
     * @return array
     */
    public function getLoadViaMainThreadList(): array
    {
        $result = [];
        $sourceList = explode(',', (string)$this->configProvider->getLoadViaMainThreadList());
        if (!empty(current($sourceList))) {
            foreach ($sourceList as $source) {
                $result[] = trim($source);
            }
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function isDebugEnabled(): bool
    {
        return $this->configProvider->isDebugEnabled();
    }


    /**
     * @return bool
     */
    public function isProxyingRequestsEnabled(): bool
    {
        return $this->configProvider->isProxyingRequestsEnabled();
    }

    /**
     * @return array
     */
    public function getForwardingEventsList(): array
    {
        $result = [];
        $eventsList = explode(',', (string)$this->configProvider->getForwardingEventsList());
        if (!empty(current($eventsList))) {
            foreach ($eventsList as $event) {
                // TODO: Refactor this
                // hardcoded value for TikTox pixel forward events
                if($event === 'ttq'){
                    $result[] = 'ttq.track, ttq.page, ttq.load';
                    continue;
                }
                $result[] = trim($event);
            }
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getProxyingRequestDomains(): string
    {
        $result = [];
        $domainsList = explode(',', (string)$this->configProvider->getProxyingRequestList());
        if (!empty(current($domainsList))) {
            foreach ($domainsList as $domain) {
                $result[] = trim($domain);
            }
        }
        return json_encode($result);
    }

    /**
     * @return string|null
     */
    public function getProxyUrl(): ?string
    {
        return $this->configProvider->getProxyUrl();
    }

    /**
     * @return array
     */
    public function getDebugConfigsList(): array
    {
        $result = [];
        $configs = explode(',', (string)$this->configProvider->getDebugConfigsList());
        if (!empty(current($configs))) {
            foreach ($configs as $config) {
                $result[] = trim($config);
            }
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getRelativePathToPartytownFolder(): string
    {
        $libUrl = $this->getViewFileUrl('Perspective_Partytown::js/lib');
        $relativePath = parse_url($libUrl, PHP_URL_PATH) . '/';
        return $relativePath;
    }

    /**
     * @return string|null
     */
    public function getConfigJson(): ?string
    {
        $config = [];
        $config = [
            'forward' => $this->getForwardingEventsList(),
            'debug' => $this->isDebugEnabled(),
            'debugModes' => $this->getDebugConfigsList(),
            'loadScriptsOnMainThread' => $this->getLoadViaMainThreadList(),
            'isProxyingEnabled' => $this->isProxyingRequestsEnabled(),
            'lib' => $this->getRelativePathToPartytownFolder()
        ];
        return json_encode($config);
    }
}
