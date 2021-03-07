<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product
            ->setName()
            ->setSlug()
            ->setDescription()
            ->setImage('/images/box.png')
            ->setPrice()
            ->setRating();

        $manager->persist($product);
        $manager->flush();
    }
}
