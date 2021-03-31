<?php

namespace App\Infrastructure\Adapter\Doctrine\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NonUniquePseudo extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public string $message = "This pseudo already exists.";
}
