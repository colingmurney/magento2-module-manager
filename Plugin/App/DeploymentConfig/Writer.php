<?php
namespace ColinMurney\ModuleManager\Plugin\App\DeploymentConfig;

use Magento\Framework\App\State as AppState;
use ColinMurney\ModuleManager\Model\Config\Config;

class Writer
{
    private AppState $appState;

    private Config $config;

    public function __construct(
        AppState $appState,
        Config   $config
    )
    {
        $this->appState = $appState;
        $this->config   = $config;
    }

    public function beforeSaveConfig(
        \Magento\Framework\App\DeploymentConfig\Writer $writer,
        array $data,
        $override = false,
        $pool = null,
        array $comments = []
    )
    {
        if ($this->appState->getMode() !== AppState::MODE_DEVELOPER) {
            return null;
        }

        foreach ($this->config->getModulesToDisable() as $module) {
            if (isset($result['modules'][$module])) {
                $override = true;
                $data['modules'][$module] = 0;
            }
        }

        return [$data, $override, $pool, $comments];
    }
}
