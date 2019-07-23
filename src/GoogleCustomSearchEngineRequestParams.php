<?php
namespace koulab\google;

class GoogleCustomSearchEngineRequestParams {
    private $cx;
    private $page = 0;
    private $cse_tok;
    private $query;
    private $sort = '';

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page): void
    {
        $this->page = $page;
    }

    public function getCx()
    {
        return $this->cx;
    }

    public function setCx($cx): void
    {
        $this->cx = $cx;
    }

    public function getCseTok()
    {
        return $this->cse_tok;
    }

    public function setCseTok($cse_tok): void
    {
        $this->cse_tok = $cse_tok;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($query): void
    {
        $this->query = $query;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function build(){
        return [
            'rsz'=>'filtered_cse',
            'num'=>'20',
            'hl'=>'ja',
            'source'=>'gcsc',
            'gss'=>'.com',
            'start'=>$this->getPage(),
            'cx'=>$this->getCx(),
            'q'=>$this->getQuery(),
            'safe'=>'off',
            'cse_tok'=>$this->getCseTok(),
            'sort'=>$this->getSort(),
            'exp'=>'csqr',
            'callback'=>'google.search.cse.api'
        ];
    }
}