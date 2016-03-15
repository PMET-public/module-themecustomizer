<?php

namespace MagentoEse\Wysiwygdesign\Controller\Adminhtml\Generate;

use MagentoEse\Wysiwygdesign\Helper\Data as HelperData;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Filesystem;
use Magento\Config\Model\Config as Config;

class Restore extends AbstractGenerate
{
    /**
     * @var Filesystem
     */
    protected $_frameworkFilesystem;

    public function __construct(Context $context,
        HelperData $helperData,
        CacheInterface $appCacheInterface, 
        Filesystem $frameworkFilesystem)
    {
        $this->_frameworkFilesystem = $frameworkFilesystem;


        parent::__construct($context, $helperData, $appCacheInterface);
    }

    /**
     * Default ajax controller for restoring values to default
     *
     * @return void
     */
    public function execute()
    {
        //instantiate new config model (has to be oldschool way, since its not abstracted)
        //$restore = new Config();
        $restore = new Config();
        //restore default values by updating config values
        $restore->saveConfig('designsettings/themesettings/topbarcolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/primaryfontcolor', "#636363", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/primarylinkcolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/primarylinkhovercolor', "#2e8ab8", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navbackgroundcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navlinkcolor', "#636363", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navlinkhovercolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navdropdownbackgroundcolor', "#fbfbfb", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navdropdownlinkcolor', "#636363", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/navdropdownlinkhovercolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/primaryheadingcolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/primarypricecolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/backgroundcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/categorygridbackgroundcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/productviewbackgroundcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/blockcontentbackgroundcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/buttonbackgroundcolor', "#3399cc", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/buttonlinkcolor', "#ffffff", 'default', 0);
        $this->restore->saveConfig('designsettings/themesettings/buttonlinkhovercolor', "#ffffff", 'default', 0);
        
        //delete all uploaded assets
        $path_to_wipe = $this->_frameworkFilesystem->getDirectoryWrite('pub')->getAbsolutePath()."/media/logo/default/*";
        array_map('unlink', glob($path_to_wipe));
        
        //update upload path in config
        $this->restore->saveConfig('designsettings/assets/logoimage', "", 'default', 0);
        
        //clear it
        $this->_appCacheInterface->flush();
        
        $result = 1;
        $this->getResponse()->setBody($result);
    }
}
