<?php

namespace citymobile;

use citymobile\AdministratorManager;
use citymobile\ArticleManager;

abstract class Controller {

    protected $articleManager;
    protected $administratorManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
        $this->administratorManager = new AdministratorManager();
    }

    /**
     * module pagination
     * @param $page
     * @param $manager
     * @param $numberPerPage
     * @return array 'articles' -> list of articles
     *              'view' -> html pagination
     */
    protected function pagination($page, $manager, $numberPerPage, $namePage, $type, $search) {
        $totalArticle = $manager->count();
        $numberPages = ceil($totalArticle / $numberPerPage);
        $firstArticle = ($page-1)*$numberPerPage;
        $return['articles'] = $manager->getList($firstArticle, $numberPerPage, $type, $search);
        $return['view'] = $this->paginationView($page, $numberPages, $namePage);
        return $return;
    }

    private function paginationView($page, $numberPage, $namePage) {
        $url = 'index.php?p='.$namePage.'&numberPage=';
        if($page>1)
            $html= '<p style="text-align: center;"><a href="'.$url.($page-1).'" class="btn btn-lg btn-dark">Page précédente</a></p>';
        else if ($page<$numberPage)
            $html= '<p style="text-align: center;"><a href="'.$url.($page+1).'" class="btn btn-lg btn-dark">Page suivante</a></p>';
        else
            $html = '';

        return $html;
    }

}