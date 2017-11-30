<?php
namespace MagentoEse\ThemeCustomizer\Model\ResourceModel;
class Element extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('magentoese_themecustomizer_elements','element_id');
    }
}
