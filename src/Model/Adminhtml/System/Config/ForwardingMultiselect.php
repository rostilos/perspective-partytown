<?php

declare(strict_types=1);

namespace Perspective\Partytown\Model\Adminhtml\System\Config;

use Perspective\Partytown\Model\Adminhtml\System\Config;
use Magento\Framework\Option\ArrayInterface;

class ForwardingMultiselect implements ArrayInterface
{

    public function toOptionArray(): array
    {
        return [
            ['value' => 'fbq', 'label' => __('Facebook Pixel')],
            ['value' => 'dataLayer.push', 'label' => __('Google Tag Manager')],
            ['value' => '_hsq.push', 'label' => __('Hubspot Tracking')],
            ['value' => 'Intercom', 'label' => __('Intercom')],
            ['value' => '_learnq.push', 'label' => __('Klaviyo')],
            ['value' => 'ttq', 'label' => __('TikTok Pixel')],
            ['value' => 'mixpanel.track', 'label' => __('Mixpanel')]
        ];
    }
}
