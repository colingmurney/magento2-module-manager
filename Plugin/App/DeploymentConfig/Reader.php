<?php
namespace ColinMurney\ModuleManager\Plugin\App\DeploymentConfig;

use Magento\Framework\App\State as AppState;
use ColinMurney\ModuleManager\Model\Config\Config;

class Reader
{
    private AppState $appState;

    private Config $config;

    private bool $flag = false;

    public function __construct(
        AppState $appState,
        Config   $config
    )
    {
        $this->appState = $appState;
        $this->config   = $config;
    }

    public function afterLoad(
        \Magento\Framework\App\DeploymentConfig\Reader $reader, array $result, $fileKey = null)
    {
        if ($this->appState->getMode() !== AppState::MODE_DEVELOPER) {
            return $result;
        }

        if ($this->flag) {
            return $result;
        }

        $this->flag = true;
        foreach ($this->config->getModulesToDisable() as $module) {
            if (isset($result['modules'][$module])) {
                $result['modules'][$module] = 0;
            }
        }

        return $result;
    }
}
