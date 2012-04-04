Provides the possibility to extend DiscriminatorMap on Inheritance Mapped classes with Class Table Inheritance.

Example configuration (config.yml):

        netpositive_discriminator_map:
            discriminator_map:
                content:
                    entity: Netpositive\CmsBundle\Entity\Content
                    children:
                        course: University\CmsBundle\Entity\Content\Course
                        phonebook_entry: University\CmsBundle\Entity\Content\PhonebookEntry


parent class:

* Netpositive\CmsBundle\Entity\Content

parent table name:

* content

children classes:

* University\CmsBundle\Entity\Content\Course
* University\CmsBundle\Entity\Content\PhonebookEntry

children table names:

* course
* phonebook_entry

This bundle was intended to extend an existing DiscriminatorMap through the config file, if you can't do it by hand (ie: the bundle you want to extend is developed outside your project). Unfortunately it doesn't work as intended due to a doctrine bug: [http://www.doctrine-project.org/jira/browse/DDC-1763](http://www.doctrine-project.org/jira/browse/DDC-1763)

We already fixed this and opened pull requests:

* [https://github.com/doctrine/doctrine2/pull/326](https://github.com/doctrine/doctrine2/pull/326)
* [https://github.com/doctrine/doctrine2/pull/327](https://github.com/doctrine/doctrine2/pull/327)
* [https://github.com/doctrine/doctrine2/pull/328](https://github.com/doctrine/doctrine2/pull/328)
