<?php
namespace SchoolStore\Fake\MessageStream;

use SchoolStore\MessageStream\ViewProductsMessageStream;
use SchoolStore\View\ProductView;


class FakeViewProductsMessageStream implements ViewProductsMessageStream
{
    private $offset = 0;
    private $limit = 0;
    public $entries = [];

    /**
     * FakeViewProductsRequest constructor.
     * @param int $limit
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    public function setPage($page = 1)
    {
        $this->offset = ($page - 1) * $this->limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getLimit()
    {
        return $this->limit;
    }


    public function addEntry(ProductView $entryView)
    {
        $this->entries[] = $entryView;
    }

}