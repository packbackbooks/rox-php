<?php

namespace Rox\Core\Consts;

class Environment
{
    const INSTANCE_ID_ENV_VAR_NAME = 'ROLLOUT_INSTANCE_ID';
    const ENV_VAR_NAME = 'ROLLOUT_MODE';
    const PRODUCTION = 'PRODUCTION';
    const QA = 'QA';
    const LOCAL = 'LOCAL';

    /**
     * @return string
     */
    public static function getRoxyInternalPath()
    {
        return 'device/request_configuration';
    }

    /**
     * @return string
     */
    public static function getCdnPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qa-conf.rollout.io';
        } else if ($env == self::LOCAL) {
            return 'https://development-conf.rollout.io';
        }
        return 'https://conf.rollout.io';
    }

    /**
     * @return string
     */
    public static function getApiPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qax.rollout.io/device/get_configuration';
        } else if ($env == self::LOCAL) {
            return 'http://127.0.0.1:8557/device/get_configuration';
        }
        return 'https://x-api.rollout.io/device/get_configuration';
    }

    /**
     * @return string
     */
    public static function getStateCdnPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qa-statestore.rollout.io';
        } else if ($env == self::LOCAL) {
            return 'https://development-statestore.rollout.io';
        }
        return 'https://statestore.rollout.io';
    }

    /**
     * @return string
     */
    public static function getStateApiPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qax.rollout.io/device/update_state_store';
        } else if ($env == self::LOCAL) {
            return 'http://127.0.0.1:8557/device/update_state_store';
        }

        return 'https://x-api.rollout.io/device/update_state_store';
    }

    /**
     * @return string
     */
    public static function getAnalyticsPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qaanalytic.rollout.io';
        } else if ($env == self::LOCAL) {
            return 'http://127.0.0.1:8787';
        }
        return 'https://analytic.rollout.io';
    }

    /**
     * @return string
     */
    public static function getNotificationsPath()
    {
        $env = self::getEnvMode();
        if ($env == self::QA) {
            return 'https://qax-push.rollout.io/sse';
        } else if ($env == self::LOCAL) {
            return 'http://127.0.0.1:8887/sse';
        }
        return 'https://push.rollout.io/sse';
    }

    /**
     * Reads the environment mode from system environment
     *
     * @return null|string
     */
    public static function getEnvMode(): ?string
    {
        return ((string) getenv(self::ENV_VAR_NAME)) ?: null;
    }
}
