<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

use Magento\Framework\Setup;

/**
 * Class Installer
 * @package MagentoEse\ThemeCustomizer\Setup
 */
class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * @var \MagentoEse\ThemeCustomizer\Model\Install\Elements
     */
    protected $elements;

    /**
     * Installer constructor.
     * @param \MagentoEse\ThemeCustomizer\Model\Install\Elements $elements
     */
    public function __construct(
        \MagentoEse\ThemeCustomizer\Model\Install\Elements $elements
    ) {
        $this->elements = $elements;
        }

    public function install()
    {
        $this->elements->install(['MagentoEse_ThemeCustomizer::fixtures/elements.csv']);
    }
}