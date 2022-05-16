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
    protected $fieldFactory;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory
     */
    protected $skin;

    /**
     * @var \MagentoEse\ThemeCustomizer\Model\ElementFactory
     */
    protected $element;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory
     */
    protected $themeCollecton;

    /**\
     * Fieldset constructor.
     * @param ContextInterface $context
     * @param array $components
     * @param array $data
     * @param FieldFactory $fieldFactory
     * @param \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory $skin
     * @param \MagentoEse\ThemeCustomizer\Model\ElementFactory $element
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollection
     */
    public function __construct(
        ContextInterface $context,
        FieldFactory $fieldFactory,
        \MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin\CollectionFactory $skin,
        \MagentoEse\ThemeCustomizer\Model\ElementFactory $element,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Theme\Model\ResourceModel\Theme\CollectionFactory $themeCollection,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
        $this->elements = $element;
        $this->skin = $skin;
        $this->request = $request;
        $this->themeCollection = $themeCollection;
    }


    /**
     * @return UiComponentInterface[]
     */
    public function getChildComponents()
    {
        $elements = $this->elements->create();
        $elementList = $elements->load(1);
        $elementData = $elementList->getCollection()->getData();
        $fields = [

            [
                'label' => __('Apply to Theme'),
                //'value' => 3,
                'formElement' => 'select',
                'options' => $this->getThemes(),
                'id'=>'applied_to'
            ]
        ];
        foreach ($elementData as $element) {
            array_push($fields, ['label' => __($element['frontend_label']),
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

    /**
     * @return array
     */
    protected function getThemes()
    {
        $options = [[
            'label' => __('--None--'),
            'value' => 0
        ]];
        $themeFactory = $this->themeCollection->create();
        $themes = $themeFactory->getItems();
        foreach ($themes as $theme) {
            if ($theme->getData('area')=='frontend') {
                array_push($options, [
                    'label' => $theme->getData('theme_title'),
                    'value' => $theme->getData('theme_id')
                ]);
            }
        }


        return $options;
    }
}
