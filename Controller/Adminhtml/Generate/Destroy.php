<?php

namespace EEsc\Wysiwygdesign\Controller\Adminhtml\Generate;

use EEsc\Wysiwygdesign\Helper\Data as HelperData;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\CacheInterface;

class Destroy extends AbstractGenerate
{

    public function __construct(Context $context, 
        HelperData $helperData, 
        CacheInterface $appCacheInterface)
    {


        parent::__construct($context, $helperData, $appCacheInterface);
    }

    /**
     * Default ajax controller for removing design
     *
     * @return void
     */
    public function execute()
    {
        $filename = $this->_getFile();

        $this->_destroyCss($filename);

        $helper = $this->_helperData;

        if ($helper->getCacheClear()) {
            $this->_clearCache();
        }

        $result = 1;
        $this->getResponse()->setBody($result);
    }
}
