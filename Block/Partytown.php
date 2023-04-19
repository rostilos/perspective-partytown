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
class Partytown extends Template
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
        return json_encode($result);
    }

    /**
     * @return mixed
     */
    public function getProxyingRequestList()
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
}
