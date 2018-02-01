<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * UpgradeSchema constructor.
     * @param SampleDataContext $sampleDataContext
     */
    public function __construct(
        SampleDataContext $sampleDataContext
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        //add columns based on fixtures file
        $fixtures = ['MagentoEse_ThemeCustomizer::fixtures/elements.csv'];

        $setup->startSetup();
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                continue;
            }
            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $dataArray= array_combine($header, $row);
                $connection = $setup->getConnection();
                $tableName = $setup->getTable('magentoese_themecustomizer_skin');
                $columnName = $dataArray['element_code'];

                if ($connection->tableColumnExists($tableName, $columnName) === false) {
                    $connection->addColumn($tableName, $columnName, array(
                        'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable'  => true,
                        'length'    => 10,
                        'comment'   => $dataArray['frontend_label']
                    ));
                }
                unset($dataArray);
            }

        }

    }
}
