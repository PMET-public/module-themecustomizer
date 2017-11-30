<?php
namespace MagentoEse\ThemeCustomizer\Ui\Component\Listing\Column\Magentoesethemecustomizerskins;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if(isset($item["skin_id"]))
                {
                    $id = $item["skin_id"];
                }
                $item[$name]["view"] = [
                    "href"=>$this->getContext()->getUrl(
                        "magentoese_themecustomizer_skins/skin/edit",["skin_id"=>$id]),
                    "label"=>__("Edit")
                ];
            }
        }

        return $dataSource;
    }    
    
}
