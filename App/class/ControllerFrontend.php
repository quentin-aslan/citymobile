<?php

namespace citymobile;

use Exception;

/**
 * Class ControllerFrontend
 * All front-end functions are here
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 08/07/2019
 */

class ControllerFrontend extends Controller {

    /**
     * Require Home Page.
     */
    public function home() {
        $articles = $this->articleManager->getList(0, 4, 'telephone');
        require ROOT.'/views/frontend/home.php';
    }

    public function listArticles($page = 1, $type = 'nothing', $search = 'nothing') {

        $pagination = $this->pagination($page, $this->articleManager, 8, 'list_articles', $type, $search);
        $articles = $pagination['articles'];
        $paginationView = $pagination['view'];

        require ROOT.'/views/frontend/listArticles.php';

    }

    private function viewModalArticle(Article $article)
    {
        require ROOT.'/views/frontend/articleModal.php';
    }

    /**
     * @param $articles array
     * @return mixed
     */
    public function viewArticle($articles)
    {
        require ROOT.'/views/frontend/article.php';

    }

}