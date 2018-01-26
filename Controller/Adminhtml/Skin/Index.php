<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;


/**
 * Class Index
 * @package MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin
 */
class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
