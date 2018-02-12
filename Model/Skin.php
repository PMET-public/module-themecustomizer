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

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->addData(['name'=>$name]);
    }

    /**
     * @param int $themeId
     */
    public function setThemeId(int $themeId)
    {
        $this->addData(['applied_to'=>$themeId]);
    }

    /**
     * @param $skinId
     */
    public function setSkinId($skinId)
    {
        $this->addData(['skin_id'=>$skinId]);
    }

    /**
     * @param bool $readOnly
     */
    public function setReadOnly(bool $readOnly)
    {
        $this->addData(['read_only'=>$readOnly]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @return int
     */
    public function getThemeId()
    {
        return $this->getData('applied_to');
    }

    /**
     * @return int
     */
    public function getSkinId()
    {
        return $this->getData('skin_id');
    }

    /**
     * @return int
     */
    public function getReadOnly()
    {
        return $this->getData('read_only');
    }
}
