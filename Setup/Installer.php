<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagentoEse\ThemeCustomizer\Setup;
use Magento\Framework\Setup;
class Installer implements Setup\SampleData\InstallerInterface
{
    protected $elements;

    public function __construct(
        \MagentoEse\ThemeCustomizer\Model\Install\Elements $elements
    ) {
        $this->elements = $elements;
        }
    /**
     * {@inheritdoc}
     */
    public function install()
    {
        $this->elements->install(['MagentoEse_ThemeCustomizer::fixtures/elements.csv']);
    }
}