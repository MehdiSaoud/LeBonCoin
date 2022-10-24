<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;
use App\Factory\AnnonceFactory;
use App\Factory\TagFactory;
use App\Factory\TagLinkFactory;
use App\Factory\VoteFactory;
use App\Factory\CommentFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::createMany(10);
        AnnonceFactory::createMany(10);
        CommentFactory::createMany(10);
        TagLinkFactory::createMany(10);
        TagFactory::createMany(10);
        VoteFactory::createMany(10);
        
    
    }
}
