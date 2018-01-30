<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Model;
class Skin extends \Magento\Framework\Model\AbstractModel implements \MagentoEse\ThemeCustomizer\Api\Data\SkinInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'magentoese_themecustomizer_skin';

    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
