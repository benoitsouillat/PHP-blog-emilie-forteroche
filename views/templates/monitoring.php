<?php

/*
* Affichage détaillé d'un article (nombre de vues, nombre de commentaire, date de publication)
*/
$titleSort = !empty($_GET['title']) ? $_GET['title'] : 'ASC';
$vuesSort = 'ASC';
$commentsSort = 'ASC';
?>

<h2>Monitoring des articles</h2>

<table class="monitoringArticle">
    <thead>
        <tr>
            <th>
                <p>Titre de l'article</p><a
                    href='index.php?action=monitoring&title=<?= $titleSort == 'ASC' ? 'DESC' : 'ASC'; ?>'>TRI</a>
            </th>
            <th>Vues </th>
            <th>Commentaires </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articlesData as $articleData) {
            $article = $articleData['article'];
        ?>
            <tr class="monitoringLine">
                <td class="title"><?= $article->getTitle() ?></td>
                <td class="vues"><?= $article->getNumberVues() ?> vue(s)</td>
                <td class="comments"><?= $articleData['numberOfComments'] ?> commentaire(s)</td>
            </tr>
        <?php } ?>
    </tbody>
</table>