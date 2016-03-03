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
namespace EEsc\Wysiwygdesign\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Text;
use Magento\Framework\UrlInterface;

class Colorpicker extends Field
{
    /**
     * @var UrlInterface
     */
    /*protected $_frameworkUrlInterface;

    public function __construct(Context $context, 
        UrlInterface $frameworkUrlInterface, 
        array $data = [])
    {
        $this->_frameworkUrlInterface = $frameworkUrlInterface;

        parent::__construct($context, $data);
    }*/



    public function __construct(
        \Magento\Framework\Data\Form\Element\TextFactory $formElementTextFactory
    ) {
        $this->formElementTextFactory = $formElementTextFactory;
    }

    /**
     * Generate HTML code for color picker
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        // Include Procolor library JS file which is in [magento_base_dir]/js/eesc/wysiwygdesign/procolor-1.0/procolor.compressed.js
        //$html = '<script type="text/javascript" src="' . $this->_frameworkUrlInterface->getBaseUrl('js') . 'eesc/wysiwygdesign/procolor-1.0/procolor.compressed.js' .'"></script>';
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        // Use Varien text element as a basis
       // $input = $this->formElementTextFactory->create();
        $html ='';
        // Use Varien text element as a basis
        $input = $this->formElementTextFactory->create();

        // Set data from config element on Varien text element
        $input->setForm($element->getForm())

            ->setElement($element)
            ->setValue($element->getValue())
            ->setHtmlId($element->getHtmlId())
            ->setName($element->getName())
            ->setStyle('width: 60px') // Update style in order to shrink width
            ->addClass('validate-hex'); // Add some Prototype validation to make sure color code is correct

        // Inject uddated Varien text element HTML in our current HTML
        $html .= $input->getHtml();

        // Inject Procolor JS code to display color picker
        $html .= $this->_getProcolorJs($element->getHtmlId());

        // Inject Prototype validation
        $html .= $this->_addHexValidator();

        return $html;
    }

    /**
     * Procolor JS code to display color picker
     *
     * @see http://procolor.sourceforge.net/examples.php
     * @param string $htmlId
     * @return string
     */
    protected function _getProcolorJs($htmlId)
    {
        //TODO
        //return '<script type="text/javascript">ProColor.prototype.attachButton(\'' . $htmlId . '\', { imgPath:\'' . $this->_frameworkUrlInterface->getBaseUrl('js') . 'eesc/wysiwygdesign/procolor-1.0/' . 'img/procolor_win_\', showInField: true });</script>';
        return '<script type="text/javascript">ProColor.prototype.attachButton(\'' . $htmlId . '\', { imgPath:\'' . 'js/procolor-1.0/' . 'img/procolor_win_\', showInField: true });</script>';
    }

    /**
     * Prototype validation
     *
     * @return string
     */
    protected function _addHexValidator()
    {
        //TODO
        //return '<script type="text/javascript">Validation.add(\'validate-hex\', \'' . __('Please enter a valid hex color code') . '\', function(v) {
		//		return /^#(?:[0-9a-fA-F]{3}){1,2}$/.test(v);
		//	});</script>';
        return '';
    }
}
