<?php

namespace GodataRest\Entity\Article;

/**
 * ArticleListEntryEntity manages the data for the article-list and in each article-list-entry the article data.
 *
 * @author allapow
 */
class ArticleListEntryEntity extends JoinArticleEntity
{

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    protected $mapping = [
        'id' => 'id',
        'articleIdParent' => 'article_id_parent',
        'articleId' => 'article_id',
        'quantity' => 'quantity',
        'desc' => 'desc',
        'countSubArticles' => 'count_sub_articles' // no db field
    ];
    protected $escapekeys = [
        'desc'
    ];

    public function save(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        $arrayCopyPure = $this->getArrayCopyPure();
        unset($arrayCopyPure['count_sub_articles']);
        return $articleListTable->createArticleListPart($arrayCopyPure);
    }

    public function update(\GodataRest\Table\Article\ArticleListTable $articleListTable)
    {
        return $articleListTable->updateArticleListPart($this->storage['id'], $this->getArrayCopyPure());
    }
}
