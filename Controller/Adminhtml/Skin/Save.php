<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;

use Magento\Backend\App\Action;
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

    protected $skinDirectory ='/media/';

    protected $cssFilename = 'demo.css';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\View\Design\Theme\ThemeProviderInterface
     */
    protected $themeProvider;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\SkinFactory
     */
    protected $skinFactory;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\ElementFactory
     */
    protected $elementFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Design\Theme\ThemeProviderInterface $themeProvider
     * @param \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory
     * @param \MagentoEse\ThemeCustomizer\Model\ElementFactory $elementFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Design\Theme\ThemeProviderInterface $themeProvider,
        \MagentoEse\ThemeCustomizer\Model\SkinFactory $skinFactory,
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $elementFactory,
        \Magento\Theme\Model\ThemeFactory $themeFactory,
        \Magento\Config\Model\ResourceModel\Config $resourceConfig
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->resourceConnection = $resourceConnection;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->themeProvider = $themeProvider;
        $this->skinFactory = $skinFactory;
        $this->elementFactory = $elementFactory;
        $this->themeFactory = $themeFactory;
        $this->resourceConfig = $resourceConfig;
        parent::__construct($context);
    }


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

            $oldThemeId = $model->getTheme();
            //remove theme_id from save. This will be set by Apply
            unset($data['theme_id']);
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the configuration.'));
                //apply CSS to theme
                $this->deploy($model, $oldThemeId);
                $this->dataPersistor->clear('magentoese_themecustomizer_skin');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['skin_id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError(__('A skin with the name ').$model->getName().__(' already exists. The name of the skin must be unique.'));
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('magentoese_themecustomizer_skin', $data);
             return $resultRedirect->setPath('*/*/edit', ['skin_id' => $this->getRequest()->getParam('skin_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param \MagentoEse\ThemeCustomizer\Model\Skin $model
     * @param int $oldThemeId
     */
    public function deploy(\MagentoEse\ThemeCustomizer\Model\Skin $model, $oldThemeId)
    {
        //if theme is not zero, apply theme and set other skin's apply_to = 0 where it = themeId
        if ($model->getData('applied_to')!=0) {
            //update magentoese_themecustomizer_skin set applied_to = 0 where apply_to = $oldThemeId
            $connection = $this->resourceConnection->getConnection();
            $sql='update magentoese_themecustomizer_skin set applied_to = 0 where applied_to ='. $model->getData('applied_to') .' and skin_id !='.$model->getData('skin_id');
            $connection->query($sql);
            $css_content = $this->generateCssContent($model);
            $this->createCSSFile($css_content, $model->getData('applied_to'));
            $this->messageManager->addSuccess(__('You have applied the skin. Clear your browser cache if necessary.'));
        } elseif ($model->getData('applied_to')==0 && $oldThemeId!=0) {
            //remove css content
            $this->createCSSFile('', $oldThemeId);
            $this->messageManager->addSuccess(__('You have removed the skin. Clear your browser cache if necessary.'));
        }
    }

    /**
     * @param \MagentoEse\ThemeCustomizer\Model\Skin $skinModel
     * @return string
     */
    public function generateCssContent(\MagentoEse\ThemeCustomizer\Model\Skin $skinModel)
    {
        $elementData = $this->elementFactory->create();
        $elements = $elementData->load(1);
        $css_content = '/* THIS FILE IS AUTO-GENERATED, DO NOT MAKE MODIFICATIONS DIRECTLY */' . "\n";
        foreach ($elements->getCollection()->getData() as $element) {
            $inString = $element['css_code'];
            $toFind = "$".$element['element_code'];
            $replaceWith = $skinModel->getData($element['element_code']);
            if ($replaceWith != null) {
                $css_content.= str_replace($toFind, $replaceWith, $inString). "\n";
            }
        }

        $css_content .= $skinModel->getData('additional_css');
        return $css_content;
    }

    /**
     * @param string $contents
     * @param int $themeId
     */
    public function createCSSFile(string $contents, int $themeId)
    {
        //find which locales to deploy to
        $cssFilename = $this->assignCSSToStore($themeId);
        //get theme information to deploy to
        $theme = $this->themeProvider->getThemeById($themeId);
        $skinDirectory = $this->skinDirectory;
        $filename = $_SERVER['DOCUMENT_ROOT'].$skinDirectory . $cssFilename;
        if (!file_exists($filename)) {
            $fh = fopen($filename, 'w');
            fclose($fh);
        }
        file_put_contents($filename, "");
        //create new file and prep for insertion
        $current = file_get_contents($filename);
        $current .= $contents;
        //rewrite it out
        file_put_contents($filename, $current);
    }

    /**
     * @return string
     */
    public function assignCSSToStore(int $themeId)
    {
        $theme = $this->themeFactory->create();
        $theme->load($themeId);
        $storeList = $this->storeManager->getStores();
        foreach ($storeList as $store) {
            $code = $store->getCode();
            //get theme from store
            $assignedThemeId = $this->scopeConfig->getValue(
                \Magento\Framework\View\DesignInterface::XML_PATH_THEME_ID,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $code
            );
            if($assignedThemeId == $themeId){
                //get design/head/includes for the store
                //$doh = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
                $content = $this->scopeConfig->getValue('design/head/includes', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store->getId());
                //replace existing theme customizer code
                $content = preg_replace("/(<!-- START THEME CUSTOMIZER -->)(.*)(<!-- END THEME CUSTOMIZER -->)/","",$content);
                //append new theme customizer code
                $content .= '<!-- START THEME CUSTOMIZER --><link  rel="stylesheet" type="text/css"  media="all" href="{{MEDIA_URL}}'.preg_replace("/[^A-Za-z0-9]/", '', $theme->getThemeTitle()).'.css" /><!-- END THEME CUSTOMIZER -->';
                //save new value
                $this->resourceConfig->saveConfig("design/head/includes", $content, \Magento\Store\Model\ScopeInterface::SCOPE_STORES, $store->getId());
            }

        }

        return preg_replace("/[^A-Za-z0-9]/", '', $theme->getThemeTitle()).'.css';
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
