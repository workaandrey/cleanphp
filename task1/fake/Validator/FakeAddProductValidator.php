<?php

namespace SchoolStore\Fake\Validator;

use SchoolStore\Validator\AddProductValidator;

class FakeAddProductValidator extends AddProductValidator
{
    protected function validate()
    {
        return false;
    }


}