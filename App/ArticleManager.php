<?php

namespace citymobile;

use PDO;

class ArticleManager extends Manager
{

    /**
     * @param Article $article
     */
    public function add(Article $article)
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

    public function update(Article $article)
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

    public function save(Article $article)
    {
        if ($article->isNew()) {
            $this->add($article);
        } else {
            $this->update($article);
        }
    }

    public function get($id)
    {
        $q = $this->db->prepare('SELECT * FROM article WHERE id = :id');
        $q->bindValue('id', $id);
        $q->execute();

        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
        $article = $q->fetch();

        $article->setDateCreate($article->getDateCreate());

        return $article;
    }

    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM article ORDER BY id DESC';
        if ($start != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$start;
        }
        $q = $this->db->query($sql);
        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
        $list = $q->fetchAll();

        // On parcourt notre liste d'article pour pouvoir placer des instances de DateTime en guise de dates d'ajout
        foreach ($list as $article) {
            $article->setDateCreate($article->getDateCreate());
        }

        return $list;
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