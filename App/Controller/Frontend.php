<?php

namespace citymobile;

/**
 * Class ControllerFrontend
 * All front-end functions are here
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 08/07/2019
 */

class ControllerFrontend {

    /**
     * Require Home Page.
     */
    public function home() {
        $article = new Article([
            'type' => 'Telphone',
            'mark' => 'Apple',
            'name' => 'Iphone7',
            'price' => '700',
            'photo' => 'photo',
            'description' => 'description'
        ]);

        $manager = new ArticleManager();
        $manager->add($article);
        //require '../views/Frontend/home.php';
    }


}