<?php

namespace Rox\Server\Client;

use Rox\Core\Client\DeviceProperties;
use Rox\Core\Client\RoxOptionsInterface;
use Rox\Core\Client\SdkSettingsInterface;
use Rox\Core\Consts\Environment;

class ServerProperties extends DeviceProperties
{
    /**
     * @var string $_distinctId
     */
    private $_distinctId;
    const INSTANCE_ID_ENV_VAR_NAME = 'ROLLOUT_INSTANCE_ID';
    /**
     * @param SdkSettingsInterface $sdkSettings
     * @param RoxOptionsInterface $roxOptions
     */
    public function __construct(
        SdkSettingsInterface $sdkSettings,
        RoxOptionsInterface $roxOptions)
    {
        parent::__construct($sdkSettings, $roxOptions);
        $this->_distinctId = isset($_ENV[self::INSTANCE_ID_ENV_VAR_NAME])
            ? $_ENV[self::INSTANCE_ID_ENV_VAR_NAME]
            : md5(join('.', [
                getmyuid(),
                getmygid(),
                get_current_user(),
                getmyinode(),
                getlastmod()
            ]));
    }

    function getLibVersion()
    {
        return parent::getLibVersion(); // TODO: get from some (PHP?) file generated during deployment?
    }

    function getDistinctId()
    {
        return $this->_distinctId;
    }
}
