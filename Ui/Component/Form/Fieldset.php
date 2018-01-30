<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
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
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $element,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollection
    )
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
        $this->elements = $element;
        $this->skin = $skin;
        $this->request = $request;
        $this->themeCollection = $themeCollection;
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
        /*foreach($elementData as $element){
            array_push($fields,['label' => __($element['frontend_label']),
                'formElement' => 'input',
                'component' => 'MagentoEse_ThemeCustomizer/js/form/element/color-select',
                'template' => 'ui/form/field',
                'elementTmpl' =>'MagentoEse_ThemeCustomizer/form/element/color-select',
                'id'=> $element['element_code']]);
        }*/
       /* array_push($fields,['label' => __('Theme'),
            'formElement' => 'select',
            'options' => $this->_getOptions(),
            'id'=> 'theme_id']);*/

        $fields = [

            [
                'label' => __('Apply to Theme'),
                //'value' => 3,
                'formElement' => 'select',
                'options' => $this->getThemes(),
                'id'=>'applied_to'
            ]
        ];
        foreach($elementData as $element){
            array_push($fields,['label' => __($element['frontend_label']),
                'formElement' => 'input',
                'component' => 'MagentoEse_ThemeCustomizer/js/form/element/color-select',
                'template' => 'ui/form/field',
                'elementTmpl' =>'MagentoEse_ThemeCustomizer/form/element/color-select',
                'id'=> $element['element_code']]);
        }

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
    protected function getThemes()
    {
        $options = [[
            'label' => __('--None--'),
            'value' => 0
        ]];
        $themeFactory = $this->themeCollection->create();
        $themes = $themeFactory->getItems();
        foreach($themes as $theme){
            if($theme->getData('area')=='frontend'){
                array_push($options,[
                    'label' => $theme->getData('theme_title'),
                    'value' => $theme->getData('theme_id')
                ]);
            }
        }


        return $options;
    }
}