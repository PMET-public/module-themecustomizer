<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

/**
 * Class Uninstall
 * @package MagentoEse\ThemeCustomizer\Setup
 */
class Uninstall implements UninstallInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $uninstaller = $setup;

        $uninstaller->getConnection()->dropTable(InstallSchema::ELEMENT_TABLE);
        $uninstaller->getConnection()->dropTable(InstallSchema::SKIN_TABLE);
    }
}
