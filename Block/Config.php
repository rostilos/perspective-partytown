<?php

namespace Perspective\Partytown\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Perspective\Partytown\Helper\Data as HelperData;

/**
 * Class Partytown
 *
 * @package Perspective\Partytown\Block
 */
class Config extends Template
{
    /**
     * @var HelperData
     */
    protected $helperData;

    /**
     * Partytown constructor.
     *
     * @param Context $context
     * @param HelperData $helperData
     * @param array $data
     */
    public function __construct(
        Context $context,
        HelperData $helperData,
        array $data = []
    ) {
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helperData->isModuleEnabled();
    }

    /**
     * @return mixed
     */
    public function getLoadViaMainThreadList()
    {
        $result = [];
        $sourceList = explode(',', $this->helperData->getLoadViaMainThreadList());
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
    public function isDebugEnabled()
    {
        return $this->helperData->isDebugEnabled();
    }


    /**
     * @return mixed
     */
    public function isProxyingRequestsEnabled()
    {
        return $this->helperData->isProxyingRequestsEnabled();
    }

    /**
     * @return mixed
     */
    public function getForwardingEventsList()
    {
        $result = [];
        $eventsList = explode(',', $this->helperData->getForwardingEventsList());
        if (!empty(current($eventsList))) {
            foreach ($eventsList as $event) {
                $result[] = trim($event);
            }
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getProxyingRequestDomains()
    {
        $result = [];
        $domainsList = explode(',', $this->helperData->getProxyingRequestList());
        if (!empty(current($domainsList))) {
            foreach ($domainsList as $domain) {
                $result[] = trim($domain);
            }
        }
        return json_encode($result);
    }

    /**
     * @return mixed
     */
    public function getProxyUrl()
    {
        return $this->helperData->getProxyUrl();
    }    

    /**
     * @return mixed
     */
    public function getDebugConfigsList()
    {
        $result = [];
        $configs = explode(',', $this->helperData->getDebugConfigsList());
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
    public function getRelativePathToPartytownFolder()
    {
        $libUrl = $this->getViewFileUrl('Perspective_Partytown::js/lib');
        $relativePath = parse_url($libUrl, PHP_URL_PATH) . '/';
        return $relativePath;
    }

    /**
     * @return mixed
     */
    public function getConfigJson()
    {
        $config = [];
        $config = [
            'forward' => $this->getForwardingEventsList(),
            'debug' => $this->isDebugEnabled(),
            'debugModes' => $this->getDebugConfigsList(),
            'loadScriptsOnMainThread' => $this->getLoadViaMainThreadList(),
            'isProxyingEnabled' => $this->isProxyingRequestsEnabled(),
            'proxyUrl' => $this->getProxyUrl(),
            'proxyingRequestDomains' => $this->getProxyingRequestDomains(),
            'lib' => $this->getRelativePathToPartytownFolder()
        ]; 
        return json_encode($config);
    }
}
