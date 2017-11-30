<?php
namespace MagentoEse\ThemeCustomizer\Api;

use MagentoEse\ThemeCustomizer\Api\Data\ElementInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ElementRepositoryInterface
{
    public function save(SkinInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(SkinInterface $page);

    public function deleteById($id);
}
