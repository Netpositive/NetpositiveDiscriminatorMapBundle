Provides the possibility to extend DiscriminatorMap on an Inheritance Mapped class with Class Table Inheritance in Symfony2 with [Doctrine ORM 2](http://docs.doctrine-project.org/projects/doctrine-orm/en/2.1/reference/inheritance-mapping.html#class-table-inheritance).

This bundle was intended to extend an existing DiscriminatorMap (comes from any mapping) through the config file, if you can't do it by hand (ie: the bundle you want to extend is developed outside your project).

## Installation

### Add to the deps file

    [NetpositiveDiscriminatorMapBundle]
        git=https://burci@github.com/Netpositive/NetpositiveDiscriminatorMapBundle.git
        target=bundles/Netpositive/DiscriminatorMapBundle

### Register the namespace in your autoload.php

    // app/autoload.php
    $loader->registerNamespaces(array(
        ...
        'Netpositive'      => __DIR__.'/../vendor/bundles',

### Enable it at your kernel

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Netpositive\DiscriminatorMapBundle\NetpositiveDiscriminatorMapBundle(),
        
## Configuration

    # app/config/config.yml
    netpositive_discriminator_map:
        discriminator_map:
            content:
                entity: Netpositive\CmsBundle\Entity\Content
                children:
                    course: University\CmsBundle\Entity\Content\Course
                    phonebook_entry: University\CmsBundle\Entity\Content\PhonebookEntry
                    ...

### Parent class:

    /**
     * Netpositive\CmsBundle\Entity\Content
     *
     * @ORM\Table(name="content")
     * @ORM\Entity()
     * @ORM\InheritanceType("JOINED")
     * @ORM\DiscriminatorColumn(name="content_type", type="string", length="20")
     * @ORM\DiscriminatorMap({"content" = "Content", "article" = "Article", ... })
     *
     */
    class Content
    {
    ...
    
### children classes:

    /**
     * University\CmsBundle\Entity\Content\Course
     *
     * @ORM\Table(name="course")
     * @ORM\Entity()
     */
    class Course extends Content
    {
    ...

    /**
     * University\CmsBundle\Entity\Content\PhonebookEntry
     *
     * @ORM\Table(name="phonebook_entry")
     * @ORM\Entity()
     */
    class PhonebookEntry extends Content
    {
    ...




## Note

Unfortunately it doesn't work as intended due to a doctrine bug: [http://www.doctrine-project.org/jira/browse/DDC-1763](http://www.doctrine-project.org/jira/browse/DDC-1763)
There is a workaround until this bug fixed: you have to configure all the DiscriminatorMap values in config file, the parent class @ORM\DiscriminatorMap should be empty or omited.

We already fixed this and opened pull requests:

* [https://github.com/doctrine/doctrine2/pull/326](https://github.com/doctrine/doctrine2/pull/326)
* [https://github.com/doctrine/doctrine2/pull/327](https://github.com/doctrine/doctrine2/pull/327)
* [https://github.com/doctrine/doctrine2/pull/328](https://github.com/doctrine/doctrine2/pull/328)
