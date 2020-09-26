<?php

namespace Models;

class Article extends Model
{
    protected $table = "articles";

    /**
     * Insère un article
     * @param array $article
     * @return void
     */
    public function save(array $article) : void
    {
        $query = $this->pdo->prepare("INSERT INTO articles VALUES (null, :title, 'test', :introduction, :content, NOW())");
        $query->execute($article);
    }
}