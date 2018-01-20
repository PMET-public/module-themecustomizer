<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{  
    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';

    public function __construct(Action\Context $context, Save $resetCss)
    {
        $this->resetCss = $resetCss;
        parent::__construct($context);
    }

    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create('MagentoEse\ThemeCustomizer\Model\Skin');
                $model->load($id);
                //if there is a theme attached to this skin, we need to reset the css
                $themeId = $model->getData('applied_to');
                if($themeId!=0){
                    //set model applied_to to 0 to trigger reset of css
                    $model->addData(['applied_to'=>0]);
                    $this->resetCss->deploy($model,$themeId);
                }
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You have deleted the skin.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['skin_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can not find a skin to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
        
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
    
}
