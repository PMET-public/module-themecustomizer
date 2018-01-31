<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Api;

use MagentoEse\ThemeCustomizer\Api\Data\SkinInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface SkinRepositoryInterface 
{
    /**
     * @param SkinInterface $page
     * @return mixed
     */
    public function save(SkinInterface $page);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param SkinInterface $page
     * @return mixed
     */
    public function delete(SkinInterface $page);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);
}
