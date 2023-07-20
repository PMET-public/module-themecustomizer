<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Api\Data;

interface SkinInterface
{
    /**
     * Get the name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set the name.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Get the applied_to.
     *
     * @return mixed
     */
    public function getAppliedTo(): mixed;

    /**
     * Set the applied_to.
     *
     * @param string $appliedTo
     * @return void
     */
    public function setAppliedTo(string $appliedTo): void;

    /**
     * Get the Theme Id.
     *
     * @return mixed
     */
    public function getThemeId(): mixed;

    /**
     * Set the Theme Id.
     *
     * @param string $appliedTo
     * @return void
     */
    public function setThemeId(string $appliedTo): void;

    /**
     * Get the additional_css.
     *
     * @return mixed
     */
    public function getAdditionalCss(): mixed;

    /**
     * Set the additional_css.
     *
     * @param string $additionalCss
     * @return void
     */
    public function setAdditionalCss(string $additionalCss): void;

    /**
     * Get the top_bar_color.
     *
     * @return mixed
     */
    public function getTopBarColor(): mixed;

    /**
     * Set the top_bar_color.
     *
     * @param string $topBarColor
     * @return void
     */
    public function setTopBarColor(string $topBarColor): void;

    /**
     * Get the primary_font_color.
     *
     * @return mixed
     */
    public function getPrimaryFontColor(): mixed;

    /**
     * Set the primary_font_color.
     *
     * @param string $primaryFontColor
     * @return void
     */
    public function setPrimaryFontColor(string $primaryFontColor): void;

    /**
     * Get the primary_link_color.
     *
     * @return mixed
     */
    public function getPrimaryLinkColor(): mixed;

    /**
     * Set the primary_link_color.
     *
     * @param string $primaryLinkColor
     * @return void
     */
    public function setPrimaryLinkColor(string $primaryLinkColor): void;

    /**
     * Get the primary_link_hover_color.
     *
     * @return mixed
     */
    public function getPrimaryLinkHoverColor(): mixed;

    /**
     * Set the primary_link_hover_color.
     *
     * @param string $primaryLinkHoverColor
     * @return void
     */
    public function setPrimaryLinkHoverColor(string $primaryLinkHoverColor): void;

    /**
     * Get the primary_heading_color.
     *
     * @return mixed
     */
    public function getPrimaryHeadingColor(): mixed;

    /**
     * Set the primary_heading_color.
     *
     * @param string $primaryHeadingColor
     * @return void
     */
    public function setPrimaryHeadingColor(string $primaryHeadingColor): void;

    /**
     * Get the primary_price_color.
     *
     * @return mixed
     */
    public function getPrimaryPriceColor(): mixed;

    /**
     * Set the primary_price_color.
     *
     * @param string $primaryPriceColor
     * @return void
     */
    public function setPrimaryPriceColor(string $primaryPriceColor): void;

    /**
     * Get the background_color.
     *
     * @return mixed
     */
    public function getBackgroundColor(): mixed;

    /**
     * Set the background_color.
     *
     * @param string $backgroundColor
     * @return void
     */
    public function setBackgroundColor(string $backgroundColor): void;

    /**
     * Get the category_grid_background_color.
     *
     * @return mixed
     */
    public function getCategoryGridBackgroundColor(): mixed;

    /**
     * Set the category_grid_background_color.
     *
     * @param string $categoryGridBackgroundColor
     * @return void
     */
    public function setCategoryGridBackgroundColor(string $categoryGridBackgroundColor): void;

    /**
     * Get the product_view_background_color.
     *
     * @return mixed
     */
    public function getProductViewBackgroundColor(): mixed;

    /**
     * Set the product_view_background_color.
     *
     * @param string $productViewBackgroundColor
     * @return void
     */
    public function setProductViewBackgroundColor(string $productViewBackgroundColor): void;

    /**
     * Get the block_content_background_color.
     *
     * @return mixed
     */
    public function getBlockContentBackgroundColor(): mixed;

    /**
     * Set the block_content_background_color.
     *
     * @param string $blockContentBackgroundColor
     * @return void
     */
    public function setBlockContentBackgroundColor(string $blockContentBackgroundColor): void;

    /**
     * Get the nav_background_color.
     *
     * @return mixed
     */
    public function getNavBackgroundColor(): mixed;

    /**
     * Set the nav_background_color.
     *
     * @param string $navBackgroundColor
     * @return void
     */
    public function setNavBackgroundColor(string $navBackgroundColor): void;

    /**
     * Get the nav_link_color.
     *
     * @return mixed
     */
    public function getNavLinkColor(): mixed;

    /**
     * Set the nav_link_color.
     *
     * @param string $navLinkColor
     * @return void
     */
    public function setNavLinkColor(string $navLinkColor): void;

    /**
     * Get the nav_link_hover_color.
     *
     * @return mixed
     */
    public function getNavLinkHoverColor(): mixed;

    /**
     * Set the nav_link_hover_color.
     *
     * @param string $navLinkHoverColor
     * @return void
     */
    public function setNavLinkHoverColor(string $navLinkHoverColor): void;

    /**
     * Get the nav_dropdown_background_color.
     *
     * @return mixed
     */
    public function getNavDropdownBackgroundColor(): mixed;

    /**
     * Set the nav_dropdown_background_color.
     *
     * @param string $navDropdownBackgroundColor
     * @return void
     */
    public function setNavDropdownBackgroundColor(string $navDropdownBackgroundColor): void;

    /**
     * Get the nav_dropdown_link_color.
     *
     * @return mixed
     */
    public function getNavDropdownLinkColor(): mixed;

    /**
     * Set the nav_dropdown_link_color.
     *
     * @param string $navDropdownLinkColor
     * @return void
     */
    public function setNavDropdownLinkColor(string $navDropdownLinkColor): void;

    /**
     * Get the nav_dropdown_link_hover_color.
     *
     * @return mixed
     */
    public function getNavDropdownLinkHoverColor(): mixed;

    /**
     * Set the nav_dropdown_link_hover_color.
     *
     * @param string $navDropdownLinkHoverColor
     * @return void
     */
    public function setNavDropdownLinkHoverColor(string $navDropdownLinkHoverColor): void;

    /**
     * Get the button_background_color.
     *
     * @return mixed
     */
    public function getButtonBackgroundColor(): mixed;

    /**
     * Set the button_background_color.
     *
     * @param string $buttonBackgroundColor
     * @return void
     */
    public function setButtonBackgroundColor(string $buttonBackgroundColor): void;

    /**
     * Get the button_link_color.
     *
     * @return mixed
     */
    public function getButtonLinkColor(): mixed;

    /**
     * Set the button_link_color.
     *
     * @param string $buttonLinkColor
     * @return void
     */
    public function setButtonLinkColor(string $buttonLinkColor): void;

    /**
     * Get the button_link_hover_color.
     *
     * @return mixed
     */
    public function getButtonLinkHoverColor(): mixed;

    /**
     * Set the button_link_hover_color.
     *
     * @param string $buttonLinkHoverColor
     * @return void
     */
    public function setButtonLinkHoverColor(string $buttonLinkHoverColor): void;
}
