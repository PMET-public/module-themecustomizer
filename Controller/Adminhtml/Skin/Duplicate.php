<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var \MagentoEse\ThemeCustomizer\Model\SkinFactory
     */
    protected $skinFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * Duplicate constructor.
     * @param Action\Context $context
     * @param \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     */
    public function __construct(
        Action\Context $context,
        \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    ) {
    
        $this->skinFactory = $skinFactory;
        $this->dateTime = $dateTime;
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
                $newName = 'Copy of '.$model->getName().' ['.$this->dateTime->gmtDate().']';
                $model->setName($newName);
               //set id of model to null so it saves a new
                $model->setSkinId(null);
                //reset theme applied to and readonly
                $model->setThemeId(0);
                $model->setReadOnly(0);
                $model->save();
                return $resultRedirect->setPath('*/*/edit', ['skin_id' => $model->getId(), '_current' => true]);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage(__('A skin with the name ').$newName.__(' already exists. The name of the skin must be unique. Change the name of the existing skin and try again'));
                // go back to edit form
                return $resultRedirect->setPath('*/*/', ['skin_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can not find a skin to duplicate.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
