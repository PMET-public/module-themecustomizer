<?php

namespace MagentoEse\ThemeCustomizer\Plugin\DataInstaller;

use MagentoEse\ThemeCustomizer\Plugin\DataInstaller\ThemeCustomizerConfiguration;

class AfterGetProcessConfiguration
{

    /** @var ThemeCustomizerConfiguration */
    protected $themeCustomizerConfiguration;

    public function __construct(ThemeCustomizerConfiguration $themeCustomizerConfiguration)
    {
        $this->themeCustomizerConfiguration = $themeCustomizerConfiguration;
    }
        
    public function afterGetProcessConfiguration(\MagentoEse\DataInstall\Model\Conf $subject, $conf)
    {
        $newConf = $conf;
        $newConf[] = ['theme_customizer.json'=>['process'=>'graphqlrows',
        'class'=>$this->themeCustomizerConfiguration,'label'=>'Loading Theme Customizer Configurations']];
        return $newConf;
    }
}
