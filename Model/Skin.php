<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */

namespace MagentoEse\ThemeCustomizer\Model;

class Skin extends \Magento\Framework\Model\AbstractModel implements \MagentoEse\ThemeCustomizer\Api\Data\SkinInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'magentoese_themecustomizer_skin';

    protected function _construct()
    {
        $this->_init('MagentoEse\ThemeCustomizer\Model\ResourceModel\Skin');
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    
    /**
     * @param $skinId
     */
    public function setSkinId($skinId)
    {
        $this->addData(['skin_id'=>$skinId]);
    }

    /**
     * @param bool $readOnly
     */
    public function setReadOnly(bool $readOnly)
    {
        $this->addData(['read_only'=>$readOnly]);
    }

    /**
     * @return int
     */
    public function getSkinId()
    {
        return $this->getData('skin_id');
    }

    /**
     * @return int
     */
    public function getReadOnly()
    {
        return $this->getData('read_only');
    }

    public function getName(): string
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->addData(['name'=>$name]);
    }

    public function getAppliedTo(): mixed
    {
        return $this->getData('applied_to');
    }

    public function setAppliedTo(string $appliedTo): void
    {
        $this->appliedTo = $appliedTo;
    }

    public function getThemeId(): mixed
    {
        return $this->getData('applied_to');
    }

    public function setThemeId(string $appliedTo): void
    {
        $this->appliedTo = $appliedTo;
    }

    public function getAdditionalCss(): mixed
    {
        return $this->getData('additional_css');
    }

    public function setAdditionalCss(string $additionalCss): void
    {
        $this->additionalCss = $additionalCss;
    }

    public function getTopBarColor(): mixed
    {
        return $this->getData('top_bar_color');
    }

    public function setTopBarColor(string $topBarColor): void
    {
        $this->topBarColor = $topBarColor;
    }

    public function getPrimaryFontColor(): mixed
    {
        return $this->getData('primary_font_color');
    }

    public function setPrimaryFontColor(string $primaryFontColor): void
    {
        $this->primaryFontColor = $primaryFontColor;
    }

    public function getPrimaryLinkColor(): mixed
    {
        return $this->getData('primary_link_color');
    }

    public function setPrimaryLinkColor(string $primaryLinkColor): void
    {
        $this->primaryLinkColor = $primaryLinkColor;
    }

    public function getPrimaryLinkHoverColor(): mixed
    {
        return $this->getData('primary_link_hover_color');
    }

    public function setPrimaryLinkHoverColor(string $primaryLinkHoverColor): void
    {
        $this->primaryLinkHoverColor = $primaryLinkHoverColor;
    }

    public function getPrimaryHeadingColor(): mixed
    {
        return $this->getData('primary_heading_color');
    }

    public function setPrimaryHeadingColor(string $primaryHeadingColor): void
    {
        $this->primaryHeadingColor = $primaryHeadingColor;
    }

    public function getPrimaryPriceColor(): mixed
    {
        return $this->getData('primary_price_color');
    }

    public function setPrimaryPriceColor(string $primaryPriceColor): void
    {
        $this->primaryPriceColor = $primaryPriceColor;
    }

    public function getBackgroundColor(): mixed
    {
        return $this->getData('background_color');
    }

    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    public function getCategoryGridBackgroundColor(): mixed
    {
        return $this->getData('category_grid_background_color');
    }

    public function setCategoryGridBackgroundColor(string $categoryGridBackgroundColor): void
    {
        $this->categoryGridBackgroundColor = $categoryGridBackgroundColor;
    }

    public function getProductViewBackgroundColor(): mixed
    {
        return $this->getData('product_view_background_color');
    }

    public function setProductViewBackgroundColor(string $productViewBackgroundColor): void
    {
        $this->productViewBackgroundColor = $productViewBackgroundColor;
    }

    public function getBlockContentBackgroundColor(): mixed
    {
        return $this->getData('block_content_background_color');
    }

    public function setBlockContentBackgroundColor(string $blockContentBackgroundColor): void
    {
        $this->blockContentBackgroundColor = $blockContentBackgroundColor;
    }

    public function getNavBackgroundColor(): mixed
    {
        return $this->getData('nav_background_color');
    }

    public function setNavBackgroundColor(string $navBackgroundColor): void
    {
        $this->navBackgroundColor = $navBackgroundColor;
    }

    public function getNavLinkColor(): mixed
    {
        return $this->getData('nav_link_color');
    }

    public function setNavLinkColor(string $navLinkColor): void
    {
        $this->navLinkColor = $navLinkColor;
    }

    public function getNavLinkHoverColor(): mixed
    {
        return $this->getData('nav_link_hover_color');
    }

    public function setNavLinkHoverColor(string $navLinkHoverColor): void
    {
        $this->navLinkHoverColor = $navLinkHoverColor;
    }

    public function getNavDropdownBackgroundColor(): mixed
    {
        return $this->getData('nav_dropdown_background_color');
    }

    public function setNavDropdownBackgroundColor(string $navDropdownBackgroundColor): void
    {
        $this->navDropdownBackgroundColor = $navDropdownBackgroundColor;
    }

    public function getNavDropdownLinkColor(): mixed
    {
        return $this->getData('nav_dropdown_link_color');
    }

    public function setNavDropdownLinkColor(string $navDropdownLinkColor): void
    {
        $this->navDropdownLinkColor = $navDropdownLinkColor;
    }

    public function getNavDropdownLinkHoverColor(): mixed
    {
        return $this->getData('nav_dropdown_link_hover_color');
    }

    public function setNavDropdownLinkHoverColor(string $navDropdownLinkHoverColor): void
    {
        $this->navDropdownLinkHoverColor = $navDropdownLinkHoverColor;
    }

    public function getButtonBackgroundColor(): mixed
    {
        return $this->getData('button_background_color');
    }

    public function setButtonBackgroundColor(string $buttonBackgroundColor): void
    {
        $this->buttonBackgroundColor = $buttonBackgroundColor;
    }

    public function getButtonLinkColor(): mixed
    {
        return $this->getData('button_link_color');
    }

    public function setButtonLinkColor(string $buttonLinkColor): void
    {
        $this->buttonLinkColor = $buttonLinkColor;
    }

    public function getButtonLinkHoverColor(): mixed
    {
        return $this->getData('button_link_hover_color');
    }

    public function setButtonLinkHoverColor(string $buttonLinkHoverColor): void
    {
        $this->buttonLinkHoverColor = $buttonLinkHoverColor;
    }
}
