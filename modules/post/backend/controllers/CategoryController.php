<?php

namespace modules\post\backend\controllers;

use core\controllers\AjaxAdminController;
use modules\post\backend\models\Category;
use modules\post\backend\models\CategorySearch;

class CategoryController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Category::className();
        $this->searchClass = CategorySearch::className();
        parent::init();
    }
}
