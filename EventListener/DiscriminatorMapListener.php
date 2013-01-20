<?php

namespace Netpositive\DiscriminatorMapBundle\EventListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Listens to loadClassMetadata event and sets
 * the discriminator map if needed
 */
class DiscriminatorMapListener
{
    private $discriminatorMap;

    /**
     * Constructor
     *
     * @param array $discriminatorMap
     */
    public function __construct($discriminatorMap)
    {
        $this->discriminatorMap = $discriminatorMap;
    }

    /**
     * Sets the discriminator map according to the config
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        $class = $metadata->getReflectionClass();

        if ($class === null) {
            $class = new \ReflectionClass($metadata->getName());
        }
        foreach ($this->discriminatorMap as $table => $config) {
            if ($class->getName() == $config['entity']) {
                $reader = new AnnotationReader;
                $discriminatorMap = array();
                if ($discriminatorMapAnnotation = $reader->getClassAnnotation($class, 'Doctrine\ORM\Mapping\DiscriminatorMap')) {
                    $discriminatorMap = $discriminatorMapAnnotation->value;
                }
                $discriminatorMap = array_merge($discriminatorMap, $config['children']);
                $discriminatorMap = array_merge($discriminatorMap, array($table => $config['entity']));
                $metadata->setDiscriminatorMap($discriminatorMap);
            }
        }
    }
}
