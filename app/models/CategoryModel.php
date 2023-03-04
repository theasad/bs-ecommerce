<?php

namespace App\Models;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use App\Enums\QueryEnums;
use PDO;


class CategoryModel extends BaseModel
{
    /**
     * @return bool|array
     */
    public function getRootCategorySummary(): bool|array
    {
        $stmt = $this->db->query(QueryEnums::ROOT_CATEGORY_SUMMARY_QUERY);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return bool|array
     */
    public function getCategoryTree(): bool|array
    {
        $stmt = $this->db->query(QueryEnums::CATEGORY_TREE_SQL);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}