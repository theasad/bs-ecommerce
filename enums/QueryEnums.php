<?php

namespace enums;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

enum QueryEnums
{
    const ROOT_CATEGORY_SUMMARY_QUERY = "WITH RECURSIVE category_table (id, name, root_name, root_id) AS (
                                                SELECT c.id, c.name, c.Name as root_name, c.id as root_id
                                                FROM category c
                                                    LEFT JOIN catetory_relations cr ON c.id = cr.categoryId
                                                WHERE ParentcategoryId is null
                                                UNION ALL
                                                SELECT c.id, c.name, s.root_name, s.root_id
                                                FROM category c
                                                    JOIN catetory_relations cr ON c.id = cr.categoryId
                                                    JOIN category_table s on cr.ParentcategoryId = s.id)
                                                select ct.root_id as category_id, ct.root_name as category_name, count(distinct i.Id) as total_items
                                            from category_table ct
                                                     left join Item_category_relations icr on ct.id = icr.categoryId
                                                     left join Item i on icr.ItemNumber = i.Number
                                            group by ct.root_id, ct.root_name
                                            order by total_items desc;";
    const CATEGORY_TREE_SQL = "WITH RECURSIVE category_tree AS (
                                    SELECT  c.Id as id,
                                                      c.Name as name,
                                                      CAST(NULL as CHAR(100)) as parent_id,
                                                      CAST(NULL as CHAR(100)) as parent_name,
                                                      0                       as level,
                                                      CAST(c.Id as CHAR(100)) as path
                                    FROM category c
                                             LEFT JOIN catetory_relations cr ON cr.categoryId = c.Id
                                    WHERE cr.ParentcategoryId IS NULL
                                    UNION ALL
                                    SELECT c.Id, c.Name,  cr.ParentcategoryId, ct.Name, ct.level + 1, CONCAT(ct.path, '->', c.id)
                                    FROM category c
                                             JOIN catetory_relations cr ON cr.categoryId = c.Id
                                             JOIN category_tree ct ON cr.ParentcategoryId = ct.id
                                )
                                SELECT  ct.id,ct.name, ct.parent_id, ct.parent_name, ct.level, ct.path, count(icr.ItemNumber) as total_items
                                from category c
                                   left join category_tree ct on CONCAT('->', ct.id, '->') like CONCAT('->%',c.Id,'->%')
                                   left join Item_category_relations icr on ct.id =  icr.categoryId
                                group by ct.id, ct.name, ct.parent_id, ct.parent_name, ct.level, ct.path
                                order by path;";
}
