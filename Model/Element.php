<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */

namespace MagentoEse\ThemeCustomizer\Model;

class Element extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\ResourceModel\Element');
    }
}
