<?php
namespace App\Repositories\Frontend;

use App\Models\Category;

class CategoryRepository extends CommonRepository
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    /**
     * 文章菜单列表
     * @return Array
     */
    public function getArticleCategoryLists()
    {
        $dicts  = $this->getRedisDictLists(['category' => ['article']]);
        $search = [
            'category_type' => $dicts['category']['article'],
            '__select__'    => ['id', 'title'],
        ];
        $result = $this->getCategoryLists($search);
        return $result;
    }

    /**
     * 视频菜单列表
     * @return Array
     */
    public function getVideoCategoryLists()
    {
        $dicts  = $this->getRedisDictLists(['category' => ['video']]);
        $search = [
            'category_type' => $dicts['category']['article'],
            '__select__'    => ['id', 'title'],
        ];
        $result = $this->getCategoryLists($search);
        return $result;
    }

    /**
     * 列表
     * @param  Array $search [type]
     * @return Object
     */
    public function getCategoryLists($search)
    {
        $default_search = [
            'status'         => 1,
            '__not_select__' => ['deleted_at', 'updated_at'],
        ];
        $search = array_merge($default_search, $search);
        return $this->getLists($search);
    }
}
