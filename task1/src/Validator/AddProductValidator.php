<?php

namespace SchoolStore\Validator;

use SchoolStore\MessageStream\AddProductMessageStream;

abstract class AddProductValidator
{
    /**
     * @var AddProductMessageStream
     */
    protected $messageStream = null;

    public function setMessageStream(AddProductMessageStream $messageStream)
    {
        $this->messageStream = $messageStream;
    }

    public function isValid()
    {
        return false === $this->validate();
    }

    abstract protected function validate();
}