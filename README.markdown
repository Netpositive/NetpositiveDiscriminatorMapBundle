Provides the possibility to extend DiscriminatorMap on an Inheritance Mapped class with Class Table Inheritance in Symfony2 with [Doctrine ORM 2](http://docs.doctrine-project.org/projects/doctrine-orm/en/2.1/reference/inheritance-mapping.html#class-table-inheritance).

This bundle was intended to extend an existing DiscriminatorMap (comes from any mapping) through the config file, if you can't do it by hand (ie: the bundle you want to extend is developed outside your project).

## Installation

### 1, Using composer

#### 1.1 Add netpositive/discriminatormapbundle to your composer.json

    {
    "require": {
        ...
        "netpositive/discriminatormapbundle": "*"

#### 1.2 Enable it at your kernel

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Netpositive\DiscriminatorMapBundle\NetpositiveDiscriminatorMapBundle(),

### 2, Using vendors

#### 2.1 Add to the deps file

    [NetpositiveDiscriminatorMapBundle]
        git=git://github.com/Netpositive/NetpositiveDiscriminatorMapBundle.git
        target=bundles/Netpositive/DiscriminatorMapBundle

#### 2.2 Register the namespace in your autoload.php

    // app/autoload.php
    $loader->registerNamespaces(array(
        ...
        'Netpositive'      => __DIR__.'/../vendor/bundles',

#### 2.3 Enable it at your kernel

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

