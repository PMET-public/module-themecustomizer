<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var \MagentoEse\ThemeCustomizer\Model\SkinFactory
     */
    protected $skinFactory;


    public function __construct(Action\Context $context,
                                \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory )
    {
        $this->skinFactory = $skinFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        // check if skin exists
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // init model and delete
                $model = $this->skinFactory->create();
                $model->load($id);
                //update name of model
                $newName = 'Copy of '.$model->getName();
                $model->setName($newName);
               //set id of model to null so it saves a new
                $model->setSkinId(null);
                //reset theme applied to
                $model->setTheme(0);
                $model->save();
                return $resultRedirect->setPath('*/*/edit', ['skin_id' => $model->getId(), '_current' => true]);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError(__('A skin with the name ').$newName.__(' already exists. The name of the skin must be unique. Change the name of this skin and save before continuing'));
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['skin_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can not find a skin to duplicate.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');

    }



}