<?php

/**
 * 
 */

namespace Mindfire\Bundle\ExpiryFieldBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mindfire\Bundle\ExpiryFieldBundle\Form\DataTransformer\ExpiryDateTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Expiry Field type class
 */
class ExpiryType extends AbstractType {

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(Container $container, $objectManagerId) {
        try {
            $this->om = $container->get($objectManagerId);
        } catch(\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            throw new \Exception("expiry.object_manager_id parameter is set to a non-existing service. Please check.");
        }
    }

    /**
     * Extend buildform to add data transformer
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $transformer = new ExpiryDateTransformer($this->om);
        $builder->addViewTransformer($transformer);
    }

    /**
     * Set default options for the expiry type field
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'years' => range(date('Y'), date('Y') + 20),
            'format' => 'MMyyyydd',
            'constraints' => new \Mindfire\Bundle\ExpiryFieldBundle\Validator\Constraints\ValidExpiry(),
        ));
    }

    /**
     * Parent type
     * @return string
     */
    public function getParent() {
        return 'date';
    }

    /**
     * Name of the field
     * @return string 
     */
    public function getName() {
        return 'expiry';
    }

}
