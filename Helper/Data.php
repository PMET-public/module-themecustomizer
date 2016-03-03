<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.

 * @category    EE Solutions Consulting Tools
 * @package     EEsc Wysiwygdesigner
 * @author      Justin Morrow <jumorrow@ebay.com>
 */
namespace EEsc\Wysiwygdesign\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;

class Data extends AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $_configScopeConfigInterface;

    /**
     * @var UrlInterface
     */
    protected $_frameworkUrlInterface;

    public function __construct(Context $context, 
        ScopeConfigInterface $configScopeConfigInterface, 
        UrlInterface $frameworkUrlInterface)
    {
        $this->_configScopeConfigInterface = $configScopeConfigInterface;
        $this->_frameworkUrlInterface = $frameworkUrlInterface;

        parent::__construct($context);
    }


    /**
     * Get hexadecimal value of configured top bar color
     * @return string
     */
    public function getTopBarColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/topbarcolor');
        return $values;
    }
    
    /**
     * Get hexadecimal value of configured primary font color
     * @return string
     */
    public function getPrimaryFontColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/primaryfontcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured primary link color
     * @return string
     */
    public function getPrimaryLinkColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/primarylinkcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured primary link hover color
     * @return string
     */
    public function getPrimaryLinkHoverColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/primarylinkhovercolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured primary heading color
     * @return string
     */
    public function getPrimaryHeadingColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/primaryheadingcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured primary price color
     * @return string
     */
    public function getPrimaryPriceColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/primarypricecolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured primary background color
     * @return string
     */
    public function getBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/backgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured category grid background color
     * @return string
     */
    public function getCategoryGridBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/categorygridbackgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured product view background color
     * @return string
     */
    public function getProductViewBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/productviewbackgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured block content background color
     * @return string
     */
    public function getBlockContentBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/blockcontentbackgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured navigation background color
     * @return string
     */
    public function getNavBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navbackgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured navigation link color
     * @return string
     */
    public function getNavLinkColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navlinkcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured navigation link hover color
     * @return string
     */
    public function getNavLinkHoverColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navlinkhovercolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured navigation dropdown menu background color
     * @return string
     */
    public function getNavDropdownBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navdropdownbackgroundcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured navigation dropdown link color
     * @return string
     */
    public function getNavDropdownLinkColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navdropdownlinkcolor');
        return $values;
    }
    
    /**
     * Get hexadecimal value of configured navigation dropdown link hover color
     * @return string
     */
    public function getNavDropdownLinkHoverColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/navdropdownlinkhovercolor');
        return $values;
    }
 
    /**
     * Get hexadecimal value of configured button background color
     * @return string
     */
    public function getButtonBackgroundColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/buttonbackgroundcolor');
        return $values;
    }
    
    /**
     * Get hexadecimal value of configured button link color
     * @return string
     */
    public function getButtonLinkColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/buttonlinkcolor');
        return $values;
    }

    /**
     * Get hexadecimal value of configured button link hover color
     * @return string
     */
    public function getButtonLinkHoverColor()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/buttonlinkhovercolor');
        return $values;
    }
    
    /**
     * Get hexadecimal value of additional CSS
     * @return string
     */
    public function getAdditionalCSS()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/themesettings/additionalstyles');
        return $values;
    }
    
    /**
     * Get logo asset
     * @return string
     */
    public function getAssetLogo()
    {
        $values = $this->_configScopeConfigInterface->getValue('designsettings/assets/logoimage');
        
        if(!$values){
            return false;
        } else {
            $full_path = $this->_frameworkUrlInterface->getBaseUrl('media').'/theme/'.$values;
            return $full_path;
        }
    }
    
    /**
     * Get cache clear value
     * @return bool
     */
    public function getCacheClear()
    {
        $values = $this->_configScopeConfigInterface->getValue('updatedesign/apply/clearcache');
        return ($values == 1 ? true : false);
    }

}
