<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use MagentoEse\ThemeCustomizer\Model\ElementFactory;

class InstallElements implements DataPatchInterface
{

    /**
     * @var ElementFactory
     */
    protected $element;

    /** @var \Magento\Framework\File\Csv  */
    protected $csvReader;

    /** @var \Magento\Framework\Setup\SampleData\FixtureManager  */
    protected $fixtureManager;

    /**
     * InstallElements constructor.
     * @param SampleDataContext $sampleDataContext
     * @param ElementFactory $element
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        ElementFactory $element
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->element = $element;
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply(){
        $this->install(['MagentoEse_ThemeCustomizer::fixtures/elements.csv']);
    }

    /**
     * @param array $fixtures
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function install(array $fixtures)
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
                $model = $this->element->create();
                $model->setData($dataArray);
                $model->save();
                unset($dataArray);
            }
        }
    }


    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return '0.0.7';
    }
}
