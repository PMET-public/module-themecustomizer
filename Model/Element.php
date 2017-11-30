<?php
namespace MagentoEse\ThemeCustomizer\Model;
class Element extends \Magento\Framework\Model\AbstractModel implements \MagentoEse\ThemeCustomizer\Api\Data\SkinInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'magentoese_themecustomizer_elements';

    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\ResourceModel\Element');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
