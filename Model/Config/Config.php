<?php
namespace ColinMurney\ModuleManager\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const CONFIG_PATH_MODULE_MANAGER_GENERAL_DISABLE_MODULES = 'module_manager/general/disable_modules';

    private ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getModulesToDisable() {
        return explode(',', $this->scopeConfig->getValue(self::CONFIG_PATH_MODULE_MANAGER_GENERAL_DISABLE_MODULES));
    }
}
