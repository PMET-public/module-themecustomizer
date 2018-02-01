<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * @var \MagentoEse\ThemeCustomizer\Model\Install\Elements
     */
    protected $elements;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\Install\Templates
     */
    protected $templates;

    /**
     * Installer constructor.
     * @param \MagentoEse\ThemeCustomizer\Model\Install\Elements $elements
     * @param \MagentoEse\ThemeCustomizer\Model\Install\Templates $templates
     */
    public function __construct(
        \MagentoEse\ThemeCustomizer\Model\Install\Elements $elements,
        \MagentoEse\ThemeCustomizer\Model\Install\Templates $templates
    ) {
        $this->elements = $elements;
        $this->templates = $templates;
        }

    public function install()
    {
        $this->elements->install(['MagentoEse_ThemeCustomizer::fixtures/elements.csv']);
        $this->templates->install(['MagentoEse_ThemeCustomizer::fixtures/templates.csv']);
    }
}