<?php
// src/src/DataFixtures/LoadData.php

namespace src\DataFixtures;

use src\Entity\User;
use src\Entity\Annonce;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
// import de la classe Faker
use Faker;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadData extends AbstractFixture implements ContainerAwareInterface, FixtureInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        CommentFactory::createMany(10)
        UserFactory::createMany(10)
        AnnonceFactory::createMany(10)
        TagFactory::createMany(10)
        TagLinkFactory::createMany(10)
        VoteFactory::createMany(10)
    }
}