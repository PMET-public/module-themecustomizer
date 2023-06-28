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
     * @param SkinInterface $skin
     * @return mixed
     */
    public function save(SkinInterface $skin);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param string $name
     * @return mixed
     */
    public function getByName(string $name);

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
