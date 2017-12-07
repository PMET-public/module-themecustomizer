<?php
namespace MagentoEse\ThemeCustomizer\Ui\Component\Form;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Component\Form\FieldFactory;
use Magento\Ui\Component\Form\Fieldset as BaseFieldset;

class Fieldset extends BaseFieldset
{
    /**
     * @var FieldFactory
     */
    private $fieldFactory;

    private $skin;

    private $element;

    private $request;

    public function __construct(
        ContextInterface $context,
        array $components = [],
        array $data = [],
        FieldFactory $fieldFactory,
        \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory $skin,
        \MagentoEse\ThemeCustomizer\Model\Elementfactory $element,
        \Magento\Framework\App\Request\Http $request
    )
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
        $this->elements = $element;
        $this->skin = $skin;
        $this->request = $request;
    }


    /**
     * Get components
     *
     * @return UiComponentInterface[]
     */
    public function getChildComponents()
    {
        $elements = $this->elements->create();
        $elementList = $elements->load(1);
        $elementData = $elementList->getCollection()->getData();
        $fields = [];
        foreach($elementData as $element){
            array_push($fields,['label' => __($element['frontend_label']),
                'formElement' => 'input',
                'id'=> $element['element_code']]);
        }

       /* $fields = [
            [
                'label' => __('Field Label From Code'),
                'value' => __('Field Value From Code'),
                'formElement' => 'input',
            ],
            [
                'label' => __('Another Field Label From Code'),
                'value' => __('Another Field Value From Code'),
                'formElement' => 'input',
            ],
            [
                'label' => __('Yet Another Field Label From Code'),
                'value' => __('Yet Another Field Value From Code'),
                'formElement' => 'input',
            ]
        ];*/

        foreach ($fields as $fieldConfig) {
            $fieldInstance = $this->fieldFactory->create();
            $name = $fieldConfig['id'];

            $fieldInstance->setData(
                [
                    'config' => $fieldConfig,
                    'name' => $name
                ]
            );

            $fieldInstance->prepare();
            $this->addComponent($name, $fieldInstance);
        }

        return parent::getChildComponents();
    }
}