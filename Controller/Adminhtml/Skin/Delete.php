<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';

    /**
     * @var Save
     */
    protected $resetCss;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\SkinFactory
     */
    protected $skinFactory;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param Save $resetCss
     * @param \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory
     */
    public function __construct(
        Action\Context $context,
        Save $resetCss,
        \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory
    ) {
    
        $this->resetCss = $resetCss;
        $this->skinFactory = $skinFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // init model and delete
                $model = $this->skinFactory->create();
                $model->load($id);
                //if there is a theme attached to this skin, we need to reset the css
                $themeId = $model->getData('applied_to');
                if ($themeId!=0) {
                    //set model applied_to to 0 to trigger reset of css
                    $model->addData(['applied_to'=>0]);
                    $this->resetCss->deploy($model, $themeId);
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

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
