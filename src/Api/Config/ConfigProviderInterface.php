<?php

declare(strict_types=1);

namespace Perspective\Partytown\Api\Config;

interface ConfigProviderInterface
{

    /* General */
    public const PARTYTOWN_IS_ENABLED = 'perspective/settings/status';
    public const LOAD_IN_MAIN_THREAD_LIST = 'perspective/settings/load_in_main_list';

    /* Forwarding Events*/
    public const FORWARDING_EVENTS_LIST = 'perspective/settings/forwarding_events_list';

    /* Proxying Requests */
    public const PROXYING_REQUESTS_IS_ENABLED = 'perspective/settings/proxying_requests_status';
    public const PROXYING_REQUESTS_LIST = 'perspective/settings/proxying_requests_domains';
    public const PROXY_URL = 'perspective/settings/proxy_url';

    /* Logging */
    public const DEBUG_IS_ENABLED = 'perspective/settings/debug_status';
    public const DEBUG_LOGGING_LIST = 'perspective/settings/debug_logging_list';

    /**
     * @return bool
     */
    public function isModuleEnabled(): bool;

    /**
     * @return null|string
     */
    public function getLoadViaMainThreadList(): ?string;

    /**
     * @return bool
     */
    public function isDebugEnabled(): bool;


    /**
     * @return string
     */
    public function getForwardingEventsList(): string;


    /**
     * @return bool
     */
    public function isProxyingRequestsEnabled(): bool;


    /**
     * @return string
     */
    public function getProxyingRequestList(): string;


    /**
     * @return null|string
     */
    public function getProxyUrl(): ?string;

    /**
     * @return mixed
     */
    public function getDebugConfigsList(): string;

}
