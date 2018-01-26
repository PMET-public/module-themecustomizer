<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

use Magento\Framework\Setup;

/**
 * Class InstallData
 * @package MagentoEse\ThemeCustomizer\Setup
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * @var Setup\SampleData\Executor
     */
    protected $executor;
    /**
     * @var Installer
     */
    protected $installer;

    /**
     * InstallData constructor.
     * @param Setup\SampleData\Executor $executor
     * @param Installer $installer
     */
    public function __construct(Setup\SampleData\Executor $executor, Installer $installer)
    {
        $this->executor = $executor;
        $this->installer = $installer;
    }

    /**
     * @param Setup\ModuleDataSetupInterface $setup
     * @param Setup\ModuleContextInterface $moduleContext
     */
    public function install(Setup\ModuleDataSetupInterface $setup, Setup\ModuleContextInterface $moduleContext)
    {
        $this->executor->exec($this->installer);
    }
}
