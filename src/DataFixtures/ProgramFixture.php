<?php


namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixture extends \Doctrine\Bundle\FixturesBundle\Fixture
{
    const TITLE = [
        'Big Bang Theory',
        'Breaking Bad'
    ];

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $titleManager)
    {
        foreach (self::TITLE as $key => $titlename) {
            $title = new Program();
            $title->setTitle($titlename);

            $titleManager->persist($title);
        }
        $titleManager->flush();
    }

}