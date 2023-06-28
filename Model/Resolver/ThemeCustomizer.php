<?php
/**
 * Copyright 2022 Adobe, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace MagentoEse\ThemeCustomizer\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use MagentoEse\DataInstallGraphQl\Model\Authentication;
use MagentoEse\ThemeCustomizer\Model\Resolver\DataProvider\ThemeCustomizer as DataProvider;


class ThemeCustomizer implements ResolverInterface{

    /** @var Authentication */
    private $authentication;

    /** @var DataProvider */
    private $dataProvider;

    /**
     * @param Authentication $authentication
     * @param DataProvider $dataProvider
     * @return void
     */
    public function __construct(
        Authentication $authentication,
        DataProvider $dataProvider
    ) {

        $this->authentication = $authentication;
        $this->dataProvider = $dataProvider;
    }

    /**
     * Get theme customizer configuration settings
     * @param Field $field 
     * @param ContextInterface $context 
     * @param ResolveInfo $info 
     * @param array|null $value 
     * @param array|null $args 
     * @return mixed|Value 
     * @throws GraphQlInputException 
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $this->authentication->authorize();

        $themeCustomizerIdentifiers = $this->getThemeCustomizerIdentifiers($args);
        $cusomizerData = $this->getCustomizerData($themeCustomizerIdentifiers);

        return [
            'items' => $cusomizerData,
        ];
    }

    /**
     * Get theme customizer identifiers
     *
     * @param array $args
     * @return string[]
     * @throws GraphQlInputException
     */
    private function getThemeCustomizerIdentifiers(array $args): array
    {
        if (!isset($args['identifiers']) || !is_array($args['identifiers']) || count($args['identifiers']) === 0) {
            throw new GraphQlInputException(__('"identifiers" of Theme Customizer configurations should be specified'));
        }
        return $args['identifiers'];
    }

    /**
     * Get customizer data
     *
     * @param array $customizerIds
     * @param string $storeCode
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    private function getCustomizerData(array $customizerIds): array
    {
        $customizerData = [];
        foreach ($customizerIds as $customizerId) {
            //try {
                $customizerData[$customizerId] = $this->dataProvider
                        ->getCustomizerData((int)$customizerId);
            //    }
            //catch (NoSuchEntityException $e) {
            //    $cartRulesData[$cartRuleIdentifier] = new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
            //}
        }
        return $customizerData;
    }
}
