<?php
/**
 * This file is a part of MindfireExpiryField Bundle
 */

namespace Mindfire\Bundle\ExpiryFieldBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Custom Constraint created for Expiry Field 
 * @Annotation
 */
class ValidExpiry extends Constraint
{

    public $message = 'Invalid Month/Year Selected';

}
