<?php

namespace citymobile;

use PDO;

class ArticleManager extends Manager
{
    private function checkExist($id): bool {
        $q = $this->db->prepare("SELECT count(*) FROM article WHERE id = :id");
        $q->bindValue('id', $id);
        $q->execute();
        return $q->fetchColumn()>0;
    }


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
     * @throws \Exception
     */
    public function get($id)
    {
        if(!$this->checkExist($id))
            throw new \Exception("L'article n'éxiste pas.");

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
     * @param string $type
     * @param string $search
     * @return array
     * @throws \Exception
     */
    public function getList($start = -1, $limit = -1, $type = 'nothing', $search = 'nothing')
    {
        $sql = 'SELECT * FROM article';
        if($type != 'nothing')
            $sql.= ' WHERE type = \''.$type.'\'';
        if($search != 'nothing')
            $sql.= ' LIKE \''.$search.'\'';
        $sql.= ' ORDER BY id DESC';
        if ($start != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$start;
        }
        $q = $this->db->query($sql);

        while($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            $articles [] = new Article($datas);
        }

        if(empty($articles))
            throw new \Exception("Une erreur est survenue lors de la récupération des articles");

        return $articles;
    }

    public function count()
    {
        $q = $this->db->query('SELECT COUNT(*) FROM article');
        return $q->fetchColumn();
    }

    public function delete($id) {
        if(!$this->checkExist($id))
            throw new \Exception("L'article que vous essayez de supprimer n'éxiste pas.");

        $q = $this->db->prepare('DELETE FROM article WHERE id = :id');
        $q->bindValue('id', $id);
        if (!$q->execute())
            throw new \Exception("L'article que vous essayez de supprimer n'éxiste pas.");


    }
}