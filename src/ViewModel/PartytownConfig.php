<?php

declare(strict_types=1);

namespace Perspective\Partytown\ViewModel;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Perspective\Partytown\Api\Config\ConfigProviderInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Asset\Repository;

class PartytownConfig implements ArgumentInterface
{
    /**
     *
     * @param ConfigProviderInterface $configProvider
     */
    public function __construct(
        private readonly ConfigProviderInterface $configProvider,
        private readonly Repository $assetRepository
    )
    {
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
        return array_map('trim', explode(',', $this->configProvider->getLoadViaMainThreadList()));
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
        return array_map(function ($value) {
            $value = trim($value);
            if ($value === 'ttq') {
                return 'ttq.track, ttq.page, ttq.load';
            }
            return $value;
        }, explode(',', $this->configProvider->getForwardingEventsList()));
    }

    /**
     * @return string
     */
    public function getProxyingRequestDomains(): string
    {
        $result = array_map('trim', explode(',', $this->configProvider->getProxyingRequestList()));
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
        return array_map('trim', explode(',', $this->configProvider->getDebugConfigsList()));
    }

    /**
     * @return string
     */
    public function getRelativePathToPartytownFolder(): string
    {
        $libUrl = $this->assetRepository->getUrl('Perspective_Partytown::js/lib');
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
}