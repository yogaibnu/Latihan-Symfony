<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $todo = new Todo();
        $todo->setDescription('Belajar Menginstall Framework Symfony');
        $todo->setIsDone(true);
        $todo->setDoneAt(new \DateTime());
        $manager->persist($todo);

        $todo = new Todo();
        $todo->setDescription('Belajar Membuat Todo dengan Framework Symfony');
        $manager->persist($todo);
        
        $todo = new Todo();
        $todo->setDescription('Belajar Lebih dalam tentang Framework Symfony');
        $manager->persist($todo);

        $todo = new Todo();
        $todo->setDescription('Menjadi Master Symfony');
        $manager->persist($todo);

        $manager->flush();
    }
}
