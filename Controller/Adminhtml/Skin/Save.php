<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;
use MagentoEse\ThemeCustomizer\Model\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
            
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = MagentoEse\ThemeCustomizer\Model\Skin::STATUS_ENABLED;
            }
            if (empty($data['skin_id'])) {
                $data['skin_id'] = null;
            }

            /** @var MagentoEse\ThemeCustomizer\Model\Skin $model */
            $model = $this->_objectManager->create('MagentoEse\ThemeCustomizer\Model\Skin');

            $id = $this->getRequest()->getParam('skin_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the configuration.'));
                $this->dataPersistor->clear('magentoese_themecustomizer_skin');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['skin_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('magentoese_themecustomizer_skin', $data);
            return $resultRedirect->setPath('*/*/edit', ['skin_id' => $this->getRequest()->getParam('skin_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }    
}
