<?php

namespace MagentoEse\ThemeCustomizer\Plugin\DataInstaller;

use MagentoEse\ThemeCustomizer\Api\Data\SkinInterface;
use MagentoEse\ThemeCustomizer\Api\SkinRepositoryInterface;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;


class ThemeCustomizerConfiguration
{
    /** @var SkinRepositoryInterface */
    protected $skinRepository;

    /** @var SkinInterface */
    protected $skinInterface;

    /** @var ThemeProviderInterface */
    protected $themeProvider;
    
    public function __construct(SkinInterface $skinInterface,
    SkinRepositoryInterface $skinRepository, ThemeProviderInterface $themeProvider)
    {
        $this->skinRepository = $skinRepository;
        $this->skinInterface = $skinInterface;
        $this->themeProvider = $themeProvider;
    }
    public function install(array $rows, $header)
    {
        $themeSettings = $this->skinRepository->getByName($rows['name']);
        $rows['skin_id'] = $themeSettings->getSkinId();
        if($rows['applied_to'] != null){
            $rows['applied_to'] = $this->themeProvider->getThemeByFullPath('frontend/'.$rows['applied_to'])->getId();
        }
       
        $themeSettings->setData($rows);
        // $themeSettings->setName($rows['name'] ?? '');
        // $themeSettings->setAppliedTo($rows['applied_to'] ?? '');
        // $themeSettings->setAdditionalCss($rows['additional_css'] ?? '');
        // $themeSettings->setTopBarColor($rows['top_bar_color'] ?? '');
        // $themeSettings->setPrimaryFontColor($rows['primary_font_color'] ?? '');
        // $themeSettings->setPrimaryLinkColor($rows['primary_link_color'] ?? '');
        // $themeSettings->setPrimaryLinkHoverColor($rows['primary_link_hover_color'] ?? '');
        // $themeSettings->setPrimaryHeadingColor($rows['primary_heading_color'] ?? '');
        // $themeSettings->setPrimaryPriceColor($rows['primary_price_color'] ?? '');
        // $themeSettings->setBackgroundColor($rows['background_color'] ?? '');
        // $themeSettings->setCategoryGridBackgroundColor($rows['category_grid_background_color'] ?? '');
        // $themeSettings->setProductViewBackgroundColor($rows['product_view_background_color'] ?? '');
        // $themeSettings->setBlockContentBackgroundColor($rows['block_content_background_color'] ?? '');
        // $themeSettings->setNavBackgroundColor($rows['nav_background_color'] ?? '');
        // $themeSettings->setNavLinkColor($rows['nav_link_color'] ?? '');
        // $themeSettings->setNavLinkHoverColor($rows['nav_link_hover_color'] ?? '');
        // $themeSettings->setNavDropdownBackgroundColor($rows['nav_dropdown_background_color'] ?? '');
        // $themeSettings->setNavDropdownLinkColor($rows['nav_dropdown_link_color'] ?? '');
        // $themeSettings->setNavDropdownLinkHoverColor($rows['nav_dropdown_link_hover_color'] ?? '');
        // $themeSettings->setButtonBackgroundColor($rows['button_background_color'] ?? '');
        // $themeSettings->setButtonLinkColor($rows['button_link_color'] ?? '');
        // $themeSettings->setButtonLinkHoverColor($rows['button_link_hover_color'] ?? '');
        $this->skinRepository->save($themeSettings);

    }

}
