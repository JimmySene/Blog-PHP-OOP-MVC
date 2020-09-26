<h1>Ajouter un article</h1>
<form action="index.php?controller=article&task=save" method="post">
    <div><label for="title">Titre : </label><input type="text" name="title" id="title"></div>
    <div><label for="intro">Introduction : </label><input type="text" name="introduction" id="intro"></div>
    <div><label for="content">Contenu : </label><textarea name="content"></textarea></div>
    <div><input type="submit" value="Envoyer"></div>
</form>