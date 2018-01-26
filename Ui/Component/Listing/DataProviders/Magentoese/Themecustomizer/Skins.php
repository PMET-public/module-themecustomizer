<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Ui\Component\Listing\DataProviders\Magentoese\Themecustomizer;

/**
 * Class Skins
 * @package MagentoEse\ThemeCustomizer\Ui\Component\Listing\DataProviders\Magentoese\Themecustomizer
 */
class Skins extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Skins constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
