<?php

namespace citymobile;

use PDO;

class ArticleManager extends Manager
{

    /**
     * Add an article to DB
     * @param Article $article
     */
    private function add(Article $article)
    {

        $q = $this->db->prepare('INSERT INTO article (type, mark, name, price, photo, description, date_create) VALUES (:type, :mark, :name, :price, :photo, :description, NOW())');
        $q->bindValue('type', $article->getType());
        $q->bindValue('mark', $article->getMark());
        $q->bindValue('name', $article->getName());
        $q->bindValue('price', $article->getPrice());
        $q->bindValue('photo', $article->getPhoto());
        $q->bindValue('description', $article->getDescription());
        $q->execute();
    }

    /**
     * Update an article to DB
     * @param Article $article
     */
    private function update(Article $article)
    {
        $q = $this->db->prepare('UPDATE article SET type = :type, mark = :mark, name = :name, price = :price, photo = :photo, description = :description WHERE id = :id');
        $q->bindValue('type', $article->getType());
        $q->bindValue('mark', $article->getMark());
        $q->bindValue('name', $article->getName());
        $q->bindValue('price', $article->getPrice());
        $q->bindValue('photo', $article->getPhoto());
        $q->bindValue('description', $article->getDescription());
        $q->bindValue('id', $article->getId());
        $q->execute();
    }

    /**
     * Public function for save an article to DB (Use Add or Update function)
     * @param Article $article
     */
    public function save(Article $article)
    {
        if ($article->isNew()) {
            $this->add($article);
        } else {
            $this->update($article);
        }
    }

    /**
     * Get an Article from DB
     * @param $id
     * @return Article
     */
    public function get($id)
    {
        $q = $this->db->prepare('SELECT * FROM article WHERE id = :id');
        $q->bindValue('id', $id);
        $q->execute();

        $article = $q->fetch(PDO::FETCH_ASSOC);

        return new Article($article);
    }

    /**
     * Get all Articles from DB
     * @param int $start
     * @param int $limit
     * @return array
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM article ORDER BY id DESC';
        if ($start != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$start;
        }
        $q = $this->db->query($sql);

        while($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            $articles [] = new Article($datas);
        }

        return $articles;
    }

    public function count()
    {
        $q = $this->db->query('SELECT COUNT(*) FROM article');
        return $q->fetchColumn();
    }

    public function delete($id) {
        $q = $this->db->prepare('DELETE FROM article WHERE id = :id');
        $q->bindValue('id', $id);
        $q->execute();
    }
}