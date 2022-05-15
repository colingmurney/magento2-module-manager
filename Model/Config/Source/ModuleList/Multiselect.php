<?php
namespace ColinMurney\ModuleManager\Model\Config\Source\ModuleList;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Config\ConfigOptionsListConstants;
use Magento\Framework\Data\OptionSourceInterface;

class Multiselect implements OptionSourceInterface
{
    private DeploymentConfig $deploymentConfig;

    public function __construct(
        DeploymentConfig $deploymentConfig
    ) {
        $this->deploymentConfig = $deploymentConfig;
    }

    public function toOptionArray()
    {
        try {
            $modules = [];
            foreach($this->deploymentConfig->get(ConfigOptionsListConstants::KEY_MODULES) as $module => $status) {
                $modules[] = [
                    'value' => $module,
                    'label' => $module
                ];
            }
            return $modules;
        } catch (\Exception $e) {
            return [];
        }
    }
}
