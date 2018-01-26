<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit;

/**
 * Class GenericButton
 * @package MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit
 */
class GenericButton
{

    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    protected $context;

    /**
     * GenericButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context
    ) {
        $this->context = $context;    
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['object_id' => $this->getObjectId()]);
    }

    /**
     * @return string
     */
    public function getApplyUrl()
    {
        return $this->getUrl('*/*/apply', ['object_id' => $this->getObjectId()]);
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->context->getRequest()->getParam('skin_id');
    }     
}
