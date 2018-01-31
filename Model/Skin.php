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

    public function setName(string $name){
        $this->addData(['name'=>$name]);
    }

    public function setTheme(int $themeId){
        $this->addData(['applied_to'=>$themeId]);
    }
    public function setSkinId($skinId){
        $this->addData(['skin_id'=>$skinId]);
    }
    public function getName(){
        return $this->getData('name');
    }

    public function getTheme(){
        return $this->getData('applied_to');
    }
    public function getSkinId(){
        return $this->getData('skin_id');
    }

}
