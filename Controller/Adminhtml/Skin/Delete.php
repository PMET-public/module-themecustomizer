<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

class Delete extends \Magento\Backend\App\Action
{  
    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';   
          
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
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You have deleted the object.'));
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
    
}
