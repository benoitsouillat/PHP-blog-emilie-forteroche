<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(): array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id): ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article): void
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article): void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article): void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id): void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function increaseNumberVues(Article $article): void
    {
        $sql = "UPDATE article SET numberVues = :numberVues WHERE id = :id";
        $this->db->query($sql, [
            'numberVues' => $article->getNumberVues() + 1,
            'id' => $article->getId()
        ]);
    }
    public function getNumberComments(Article $article): void
    {
        $sql = "SELECT COUNT(id) as number_of_comments FROM comment WHERE id_article = :id_article";
        $result = $this->db->query($sql, [
            'id_article' => $article->getId()
        ]);
        $data = $result->fetch();
        $article->setNumberComments($data['number_of_comments']);
    }

    public static function articleTitleASC($a, $b)
    {
        return $a->getTitle() <=> $b->getTitle();
    }
    public static function articleTitleDESC($a, $b)
    {
        return $b->getTitle() <=> $a->getTitle();
    }

    public static function articleVuesASC($a, $b)
    {
        return $a->getNumberVues() <=> $b->getNumberVues();
    }
    public static function articleVuesDESC($a, $b)
    {
        return $b->getNumberVues() <=> $a->getNumberVues();
    }

    public static function articleNumberCommentsASC($a, $b)
    {
        return $a->getNumberComments() <=> $b->getNumberComments();
    }
    public static function articleNumberCommentsDESC($a, $b)
    {
        return $b->getNumberComments() <=> $a->getNumberComments();
    }

    public static function articleDateASC($a, $b)
    {
        return $a->getDateCreation() <=> $b->getDateCreation();
    }
    public static function articleDateDESC($a, $b)
    {
        return $b->getDateCreation() <=> $a->getDateCreation();
    }
}
