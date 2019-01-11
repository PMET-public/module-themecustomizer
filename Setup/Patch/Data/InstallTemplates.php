<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */

namespace MagentoEse\ThemeCustomizer\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use MagentoEse\ThemeCustomizer\Model\SkinFactory;

class InstallTemplates implements DataPatchInterface, PatchVersionInterface
{

    /**
     * @var SkinFactory
     */
    protected $template;

    /** @var \Magento\Framework\File\Csv  */
    protected $csvReader;

    /** @var \Magento\Framework\Setup\SampleData\FixtureManager  */
    protected $fixtureManager;

    /**
     * Templates constructor.
     * @param SampleDataContext $sampleDataContext
     * @param \MagentoEse\ThemeCustomizer\Model\SkinFactory $template
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        SkinFactory $template
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->template = $template;
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply(){
        $this->install(['MagentoEse_ThemeCustomizer::fixtures/templates.csv']);
    }

    /**
     * @param array $fixtures
     */
    private function install(array $fixtures)
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                continue;
            }

            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $dataArray= array_combine($header, $row);
                $model = $this->template->create();
                $model->setData($dataArray);
                $model->save();
                unset($dataArray);
            }
        }
    }


    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [InstallElements::class];
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return '0.0.7';
    }


    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
