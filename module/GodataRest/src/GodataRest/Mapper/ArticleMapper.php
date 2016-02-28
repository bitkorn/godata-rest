<?php

namespace GodataRest\Mapper;

/**
 * Description of ArticleMapper
 *
 * @author allapow
 */
class ArticleMapper extends AbstractMapper
{

    const ENTITY_CLASS_FQN = '\GodataRest\Entity\Article';

    /**
     *
     * @var array Array with Key=property; value=db column
     */
    private $mapping = [
        'id' => 'id',
        'articleNo' => 'article_no',
        'articleType' => 'article_type',
        'articleGroup' => 'article_group',
        'articleClass' => 'article_class',
        'descShort' => 'desc_short'
    ];

    public function computeData()
    {
        parent::computeData();
        $this->entity = new \GodataRest\Entity\Article\ArticleEntity();
        $flipedMap = array_flip($this->mapping);
        foreach ($this->data as $key => $value) {
            if (isset($flipedMap[$key])) {
                call_user_func_array([$this->entity, 'set' . ucfirst($flipedMap[$key])], [$value]);
            }
        }
    }

}
