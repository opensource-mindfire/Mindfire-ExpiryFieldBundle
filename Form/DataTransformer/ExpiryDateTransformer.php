<?php
/**
 * This file is a part of MindfireExpiryField Bundle
 */

namespace Mindfire\Bundle\ExpiryFieldBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Transformer class for ExpiryField type
 */
class ExpiryDateTransformer implements DataTransformerInterface
{

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Return 'day' field of the expiry date field
     *
     * @param  $ccExp|null 
     * @return array
     */
    public function transform($ccExp)
    {
        if (isset($ccExp['day'])) {
            unset($ccExp['day']);
        }
        return $ccExp;
    }

    /**
     * Adds last day of selected month as the 'day' component
     * @param array $ccExp
     * @throws Exception
     * @return array
     */
    public function reverseTransform($ccExp)
    {
        try {
            if (!isset($ccExp['month']) || !isset($ccExp['year'])) {
                throw new TransformationFailedException('Error in the input of expiry field type');
            }
            $lastDayofMonth = date('t', mktime(0, 0, 0, $ccExp['month'], 1, $ccExp['year']));
            $ccExp['day'] = $lastDayofMonth;
            return $ccExp;
        } catch (TransformationFailedException $e) {
            throw new Exception($e->getMessage());
        }
    }

}
