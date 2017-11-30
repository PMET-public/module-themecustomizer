<?php
/**
 * Created by PhpStorm.
 * User: jbritts
 * Date: 11/30/17
 * Time: 11:32 AM
 */

namespace MagentoEse\ThemeCustomizer\Model\Install;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

class Elements
{
    public function __construct(
        SampleDataContext $sampleDataContext,
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $element
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->element = $element;

    }
    public function install($fixtures){
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