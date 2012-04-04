<?php

namespace Netpositive\DiscriminatorMapBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\ORM\Events;

/**
 * Attaches our custom listener to the Doctrine\ORM\Events::loadClassMetadata event
 * 
 * @author aswyx
 *
 */
class NetpositiveDiscriminatorMapBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * (non-PHPdoc)
     * @see Symfony\Component\HttpKernel\Bundle.Bundle::boot()
     */
    public function boot() {
        $em = $this->container->get('doctrine.orm.default_entity_manager');
        $discriminatorMapListener = $this->container->get('netpositive_discriminator_map');

        $evm = $em->getEventManager();
        $evm->addEventListener(Events::loadClassMetadata, $discriminatorMapListener);
    }
}
