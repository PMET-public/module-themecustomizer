<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Model\Install;

use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

class Elements
{

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\ElementFactory
     */
    protected $element;

    /**
     * Elements constructor.
     * @param SampleDataContext $sampleDataContext
     * @param \MagentoEse\ThemeCustomizer\Model\ElementFactory $element
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $element
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->element = $element;
    }

    /**
     * @param array $fixtures
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
}
