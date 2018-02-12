<?php
namespace SchoolStore\MessageStream;

use SchoolStore\View\ProductView;

interface ViewProductsMessageStream
{
    public function getOffset();
    public function getLimit();
    public function addEntry(ProductView $entryView);
}