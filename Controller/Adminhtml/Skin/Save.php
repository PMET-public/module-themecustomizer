<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
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
    //protected $skinDirectory ='/static/frontend/Magento/luma/en_US/MagentoEse_ThemeCustomizer/css/';
    protected $skinDirectoryPrefix ='/static/frontend/';
    protected $skinDirectorySuffix ='/MagentoEse_ThemeCustomizer/css/';
    protected $cssFilename = 'demo.css';
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
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Design\Theme\ThemeProviderInterface $themeProvider,
        \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory,
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $elementFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->resourceConnection = $resourceConnection;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->themeProvider = $themeProvider;
        $this->skinFactory = $skinFactory;
        $this->elementFactory = $elementFactory;
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
            $model = $this->skinFactory->create();

            $id = $this->getRequest()->getParam('skin_id');
            if ($id) {
                $model->load($id);
            }
            $oldThemeId = $model->getData('applied_to');
            //remove theme_id from save. This will be set by Apply
            unset($data['theme_id']);
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the configuration.'));
                //apply CSS to theme
                $this->deploy($model,$oldThemeId);
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

    public function deploy($model,$oldThemeId){
        //if theme is not zero, apply theme and set other skin's apply_to = 0 where it = themeId
        if($model->getData('applied_to')!=0){
            //update magentoese_themecustomizer_skin set applied_to = 0 where apply_to = $oldThemeId
            $connection = $this->resourceConnection->getConnection();
            $sql='update magentoese_themecustomizer_skin set applied_to = 0 where applied_to ='. $model->getData('applied_to') .' and skin_id !='.$model->getData('skin_id');
            $connection->query($sql);
            $css_content = $this->generateCssContent($model);
            $this->createCSSFile($css_content,$model->getData('applied_to'));
            $this->messageManager->addSuccess(__('You have applied the skin.'));
        }elseif($model->getData('applied_to')==0&&$oldThemeId!=0){
            //remove css content
            $this->createCSSFile('',$oldThemeId);
            $this->messageManager->addSuccess(__('You have removed the skin.'));
        }
    }

    public function generateCssContent($skinModel)
    {
        $elementData = $this->elementFactory->create();
        $elements = $elementData->load(1);
        $css_content = '/* THIS FILE IS AUTO-GENERATED, DO NOT MAKE MODIFICATIONS DIRECTLY */' . "\n";
        foreach ($elements->getCollection()->getData() as $element )
        {
            $inString = $element['css_code'];
            $toFind = "$".$element['element_code'];
            $replaceWith = $skinModel->getData($element['element_code']);
            if($replaceWith != null){
                $css_content.= str_replace($toFind,$replaceWith,$inString). "\n";
            }
        }

        $css_content .= $skinModel->getData('additional_css');
        return $css_content;
    }
    public function createCSSFile($contents,$themeId)
    {
        //find which locales to deploy to
        $locales = $this->getAssignedLocales();
        //get theme information to deploy to
        $theme = $this->themeProvider->getThemeById($themeId);
        foreach($locales as $locale){
            $skinDirectory = $this->skinDirectoryPrefix.$theme->getThemePath().'/'.$locale.$this->skinDirectorySuffix;
            $filename = '';
            $filename = $_SERVER['DOCUMENT_ROOT'].$skinDirectory . $this->cssFilename;
            //$filename = str_replace("pub","",$_SERVER['DOCUMENT_ROOT']).$filename;
            if (!file_exists($filename)) {
                mkdir($_SERVER['DOCUMENT_ROOT'].$skinDirectory,0744,true);
                $fh = fopen($filename, 'w');
                fclose($fh);
            }
            //reset the file
            file_put_contents($filename, "");
            //create new file and prep for insertion
            $current = file_get_contents($filename);
            $current .= $contents;
            //rewrite it out
            file_put_contents($filename, $current);
        }

    }

    public function getAssignedLocales(){
        $storeList = $this->storeManager->getStores();
        $locales = [];
        foreach($storeList as $store){
            $locale =  $this->scopeConfig->getValue('general/locale/code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store->getId());
            if(!in_array($locale, $locales)){
                $locales[]=$locale;
            }
        }
        return $locales;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
