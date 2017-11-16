<?
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Config;

class Index extends \Magento\Backend\App\Action
{


    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'MagentoEse_ThemeCustomizer::Config'
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Theme Customizer'));
        $this->_view->renderLayout();
    }
}