<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Model\Install;

use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

class Templates
{

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\SkinFactory
     */
    protected $template;

    /**
     * Templates constructor.
     * @param SampleDataContext $sampleDataContext
     * @param \MagentoEse\ThemeCustomizer\Model\SkinFactory $template
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        \MagentoEse\ThemeCustomizer\Model\SkinFactory $template
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->template = $template;
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
                $model = $this->template->create();
                $model->setData($dataArray);
                $model->save();
                unset($dataArray);
            }
        }
    }
}
