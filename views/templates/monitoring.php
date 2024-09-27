<?php

/*
* Affichage détaillé d'un article (nombre de vues, nombre de commentaire, date de publication)
*/
$titleSort = !empty($_GET['title']) ? $_GET['title'] : 'ASC';
$vuesSort = !empty($_GET['vues']) ? $_GET['vues'] : 'ASC';
$commentsSort = !empty($_GET['comments']) ? $_GET['comments'] : 'ASC';
$dateSort = !empty($_GET['date']) ? $_GET['date'] : 'ASC';
?>

<h2>Monitoring des articles</h2>

<table class="monitoringArticle">
    <thead>
        <tr>
            <th>
                <p>Titre de l'article<a
                        href='index.php?action=monitoring&title=<?= $titleSort == 'ASC' ? 'DESC' : 'ASC'; ?>'>
                        <?= $titleSort == 'ASC' ?
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,6 5,3 8,6" fill="none" stroke="black" stroke-width="2"/></svg>'
                            :
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,4 5,7 8,4" fill="none" stroke="black" stroke-width="2"/></svg>'
                        ?></a>
                </p>
            </th>
            <th>
                <p>Vues<a href='index.php?action=monitoring&vues=<?= $vuesSort == 'ASC' ? 'DESC' : 'ASC'; ?>'>
                        <?= $vuesSort == 'ASC' ?
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,6 5,3 8,6" fill="none" stroke="black" stroke-width="2"/></svg>'
                            :
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,4 5,7 8,4" fill="none" stroke="black" stroke-width="2"/></svg>'
                        ?></a>
                </p>
            </th>
            <th>
                <p>Commentaires<a
                        href='index.php?action=monitoring&comments=<?= $commentsSort == 'ASC' ? 'DESC' : 'ASC'; ?>'>
                        <?= $commentsSort == 'ASC' ?
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,6 5,3 8,6" fill="none" stroke="black" stroke-width="2"/></svg>'
                            :
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,4 5,7 8,4" fill="none" stroke="black" stroke-width="2"/></svg>'
                        ?></a>
                </p>
            </th>
            <th>
                <p>Date de publication<a
                        href='index.php?action=monitoring&date=<?= $dateSort == 'ASC' ? 'DESC' : 'ASC'; ?>'>
                        <?= $dateSort == 'ASC' ?
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,6 5,3 8,6" fill="none" stroke="black" stroke-width="2"/></svg>'
                            :
                            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <polyline points="2,4 5,7 8,4" fill="none" stroke="black" stroke-width="2"/></svg>'
                        ?></a>
                </p>
            </th>
        </tr>
        <tr>
            <th>
                <p>Titre de l'article</p>
            </th>
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
            <td class="date">Créé le : <?= date_format($article->getDateCreation(), "d-m-Y") ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>