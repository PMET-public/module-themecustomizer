<?php
/**
 * Copyright 2022 Adobe, Inc. All rights reserved.
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace MagentoEse\ThemeCustomizer\Model\Resolver\DataProvider;

use MagentoEse\ThemeCustomizer\Api\SkinRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;

class ThemeCustomizer
{
    /**
     * @var SkinRepositoryInterface
     */
    protected $skinRepository;

    /**
     * @var ThemeProviderInterface
     */
    protected $themeProvider;

    /**
     * 
     * @param SkinRepositoryInterface $skinRepository 
     * @param ThemeProviderInterface $themeProvider 
     * @return void 
     */
    public function __construct(
        SkinRepositoryInterface $skinRepository,
        ThemeProviderInterface $themeProvider
    ) {
        $this->skinRepository = $skinRepository;
        $this->themeProvider = $themeProvider;
    }

    /**
     * Get source by code
     *
     * @param string $sourcecode
     * @return array
     * @throws NoSuchEntityException
     */
    public function getCustomizerData(string $customizerId): array
    {
        $sourceData = $this->fetchCustomizerData($customizerId);

        return $sourceData;
    }

    /**
     * Fetch group data by either id or field
     *
     * @param mixed $identifier
     * @return array
     * @throws NoSuchEntityException
     */
    private function fetchCustomizerData($customizerId): array
    {
        $themeConfiguration = $this->skinRepository->getById((int) $customizerId);
        if (empty($themeConfiguration)) {
            throw new NoSuchEntityException(
                __('The Theme Customizer Configuaration wtih id " "%1" doesn\'t exist.', $customizerId)
            );
        }
        $theme = $this->themeProvider->getThemeById($themeConfiguration->getAppliedTo());

        return [
            'name' => $themeConfiguration->getName(),
            'applied_to' => $theme->getThemePath(),
            'additional_css' => $themeConfiguration->getAdditionalCss(),
            'top_bar_color' => $themeConfiguration->getTopBarColor(),
            'primary_font_color' => $themeConfiguration->getPrimaryFontColor(),
            'primary_link_color' => $themeConfiguration->getPrimaryLinkColor(),
            'primary_link_hover_color' => $themeConfiguration->getPrimaryLinkHoverColor(),
            'primary_heading_color' => $themeConfiguration->getPrimaryHeadingColor(),
            'primary_price_color' => $themeConfiguration->getPrimaryPriceColor(),
            'background_color' => $themeConfiguration->getBackgroundColor(),
            'category_grid_background_color' => $themeConfiguration->getCategoryGridBackgroundColor(),
            'product_view_background_color' => $themeConfiguration->getProductViewBackgroundColor(),
            'block_content_background_color' => $themeConfiguration->getBlockContentBackgroundColor(),
            'nav_background_color' => $themeConfiguration->getNavBackgroundColor(),
            'nav_link_color' => $themeConfiguration->getNavLinkColor(),
            'nav_link_hover_color' => $themeConfiguration->getNavLinkHoverColor(),
            'nav_dropdown_background_color' => $themeConfiguration->getNavDropdownBackgroundColor(),
            'nav_dropdown_link_color' => $themeConfiguration->getNavDropdownLinkColor(),
            'nav_dropdown_link_hover_color' => $themeConfiguration->getNavDropdownLinkHoverColor(),
            'button_background_color' => $themeConfiguration->getButtonBackgroundColor(),
            'button_link_color' => $themeConfiguration->getButtonLinkColor(),
            'button_link_hover_color' => $themeConfiguration->getButtonLinkHoverColor()
        ];
    }
}
