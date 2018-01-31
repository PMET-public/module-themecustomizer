<?php
namespace MagentoEse\ThemeCustomizer\Block\Adminhtml\Skin\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class DuplicateButton extends GenericButton implements ButtonProviderInterface
{     
    public function getButtonData()
    {
        if(!$this->getObjectId()) { return []; }
        return [
                'label' => __('Duplicate'),
                'class' => 'duplicate',
                'on_click' => sprintf("location.href = '%s';", $this->getDuplicateUrl()),
                'sort_order' => 20,
            ];
    }
}
