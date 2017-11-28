<?php
namespace Magebuzz\Staff\Block\Adminhtml;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_config';
        $this->_blockGroup = 'Magebuzz_Staff';
        $this->_headerText = __('Staffing Grid');

        parent::_construct();

        if ($this->_isAllowedAction('Magebuzz_Staff::save')) {
            $this->buttonList->update('add', 'label', __('Add New Staff'));
        } else {
            $this->buttonList->remove('add');
        }
    }

   /* protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }*/
}