<?php

namespace SchoolStore\MessageStream;

interface AddProductMessageStream
{
    public function getName();

    public function getDescription();

    public function getCategory();
}