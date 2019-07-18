<?php

namespace App\DataFixtures;


use App\Entity\Topic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TopicFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
            $topic = new Topic();
            $topic->setDesignation('Angular');
            $topic1 = new Topic();
            $topic1->setDesignation('Symfony');
            $topic2 = new Topic();
            $topic2->setDesignation('.Net');
            $topic3 = new Topic();
            $topic3->setDesignation('Digital Marketing');
            $manager->persist($topic);
            $manager->persist($topic1);
            $manager->persist($topic2);
            $manager->persist($topic3);
            $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['formGroupe'];
    }
}
