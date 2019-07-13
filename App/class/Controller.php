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
    protected function pagination($page, $manager, $numberPerPage, $namePage) {
        $totalArticle = $manager->count();
        $numberPages = ceil($totalArticle / $numberPerPage);
        $firstArticle = ($page-1)*$numberPerPage;
        $return['articles'] = $manager->getList($firstArticle, $numberPerPage);
        $return['view'] = $this->paginationView($page, $numberPages, $namePage);
        return $return;
    }

    private function paginationView($page, $numberPage, $namePage) {
        $url = 'index.php?p='.$namePage.'&numberPage=';
        $html = '<nav aria-label="pagination">';
        $html .= '<ul class="pagination">';
        if($page>1)
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.($page-1).'">Page précédente</a></li>';
        if($page<$numberPage)
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.($page+1).'" >Page suivante</a></li>';
        $html .= '</ul></nav>';

        return $html;
    }

}