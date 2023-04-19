<?php
 
namespace Perspective\Partytown\Model\Config;
 
class ForwardingMultiselect implements \Magento\Framework\Option\ArrayInterface
{
 
    public function toOptionArray()
    {
        return [
            ['value' => 'fbq', 'label' => __('Facebook Pixel')],
            ['value' => 'dataLayer.push', 'label' => __('Google Tag Manager')],
            ['value' => '_hsq.push', 'label' => __('Hubspot Tracking')],
            ['value' => 'Intercom', 'label' => __('Intercom')],
            ['value' => '_learnq.push', 'label' => __('Klaviyo')],
            ['value' => 'ttq.track, ttq.page, ttq.load', 'label' => __('TikTok Pixel')],
            ['value' => 'mixpanel.track', 'label' => __('Mixpanel')]
        ];
    }
}