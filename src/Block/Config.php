<?php

declare(strict_types=1);

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
        return $this->formatStringListToArray($this->configProvider->getLoadViaMainThreadList());
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
        return $this->formatStringListToArray($this->configProvider->getForwardingEventsList());
    }

    /**
     * @return string
     */
    public function getProxyingRequestDomains(): string
    {
        $result = $this->formatStringListToArray($this->configProvider->getProxyingRequestList());
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
        return $this->formatStringListToArray($this->configProvider->getDebugConfigsList());
    }

    /**
     * @return string
     */
    public function getRelativePathToPartytownFolder(): string
    {
        $libUrl = $this->getViewFileUrl('Perspective_Partytown::js/lib');
        return parse_url($libUrl, PHP_URL_PATH) . '/';
    }

    /**
     * @return string
     */
    public function getConfigJson(): string
    {
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

    /**
     * @param string $separator
     * @param string $string
     * @return array
     */
    private function formatStringListToArray(string $string, string $separator = ','): array
    {
        $arrayFromString = $this->configProvider->getLoadViaMainThreadList();
        if (empty(current($arrayFromString))) {
            return [];
        }
        return array_map('trim', explode($separator, $arrayFromString));
    }
}
