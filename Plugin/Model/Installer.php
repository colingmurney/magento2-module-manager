<?php
namespace ColinMurney\ModuleManager\Plugin\Model;

use Magento\Framework\Module\Status as ModuleStatus;
use Magento\Framework\App\State as AppState;
use ColinMurney\ModuleManager\Model\Config\Config;

class Installer
{
    private ModuleStatus $moduleStatus;

    private AppState $appState;

    private Config $config;

    public function __construct(
        ModuleStatus $moduleStatus,
        AppState     $appState,
        Config       $config
    )
    {
        $this->moduleStatus = $moduleStatus;
        $this->appState     = $appState;
        $this->config       = $config;
    }

    public function beforeUpdateModulesSequence(
        \Magento\Setup\Model\Installer $installer,
        $keepGeneratedFiles = false
    )
    {
        if ($this->appState->getMode() !== AppState::MODE_DEVELOPER) {
            return;
        }

        $this->moduleStatus->setIsEnabled(false, $this->config->getModulesToDisable());
    }
}
