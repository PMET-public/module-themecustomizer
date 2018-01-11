<?php
namespace MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class ApplyButton extends GenericButton implements ButtonProviderInterface
{     
    public function getButtonData()
    {
        if(!$this->getObjectId()) { return []; }
        return [
                'label' => __('Apply'),
                'class' => 'apply',
                'method' => 'post',
                'on_click' => 'deleteConfirm( \'' . __(
                    'This will apply this skin to the theme. Are you sure you want to do this?'
                ) . '\', \'' . $this->getApplyUrl() . '\')',
                'sort_order' => 20,
            ];
    }
}
