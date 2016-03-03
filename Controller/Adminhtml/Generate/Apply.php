<?php

namespace EEsc\Wysiwygdesign\Controller\Adminhtml\Generate;

use EEsc\Wysiwygdesign\Helper\Data as HelperData;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\CacheInterface;

class Apply extends AbstractGenerate
{

    public function __construct(Context $context, 
        HelperData $helperData, 
        CacheInterface $appCacheInterface)
    {


        parent::__construct($context, $helperData, $appCacheInterface);
    }

    /**
     * Default ajax controller for applying settings
     *
     * @return void
     */
    public function execute()
    {
        $css_content = $this->_generateCssContent();
        $this->_createCSSFile($css_content);

        $helper = $this->_helperData;

        if ($helper->getCacheClear()) {
            $this->_clearCache();
        }

        $result = 1;
        $this->getResponse()->setBody($result);
    }
}
