<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        if(!$this->getObjectId()) { return []; }
        return [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm( \'' . __(
                    'Are you sure you want to delete this skin?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
    }
}
