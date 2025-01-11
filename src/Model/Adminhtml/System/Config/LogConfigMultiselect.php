<?php

declare(strict_types=1);

namespace Perspective\Partytown\Model\Adminhtml\System\Config;

use Perspective\Partytown\Model\Adminhtml\System\Config;
use Magento\Framework\Option\ArrayInterface;

class LogConfigMultiselect implements ArrayInterface
{

    public function toOptionArray(): array
    {
        return [
            ['value' => 'logCalls', 'label' => __('Log method calls')],
            ['value' => 'logGetters', 'label' => __('Log getter calls')],
            ['value' => 'logSetters', 'label' => __('Log setter calls')],
            ['value' => 'logImageRequests', 'label' => __('Log Image() src requests')],
            ['value' => 'logScriptExecution', 'label' => __('Log script executions')],
            ['value' => 'logSendBeaconRequests', 'label' => __('Log navigator.sendBeacon() requests')],
            ['value' => 'logStackTraces', 'label' => __('Log stack traces')]
        ];
    }
}