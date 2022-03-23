<?php

namespace App\DataFixtures;

use App\Entity\HorseCoat;
use App\Entity\HorseSchleich;
use App\Entity\HorseSpecies;
use App\Entity\HorseType;
use App\Entity\ObjectFamily;
use App\Entity\Petshop;
use App\Entity\PetshopSize;
use App\Entity\PetshopSpecies;
use App\Entity\User;
use App\Repository\HorseCoatRepository;
use App\Repository\HorseSpeciesRepository;
use App\Repository\HorseTypeRepository;
use App\Repository\ObjectFamilyRepository;
use App\Repository\PetshopSizeRepository;
use App\Repository\PetshopSpeciesRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $encoder;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var PetshopSizeRepository
     */
    private PetshopSizeRepository $petshopSizeRepository;

    /**
     * @var PetshopSpeciesRepository
     */
    private PetshopSpeciesRepository $petshopSpeciesRepository;

    /**
     * @var HorseCoatRepository
     */
    private HorseCoatRepository $horseCoatRepository;

    /**
     * @var HorseTypeRepository
     */
    private HorseTypeRepository $horseTypeRepository;

    /**
     * @var HorseSpeciesRepository
     */
    private HorseSpeciesRepository $horseSpeciesRepository;

    /**
     * @var ObjectFamilyRepository
     */
    private ObjectFamilyRepository $objectFamilyRepository;

    /**
     * @param UserPasswordHasherInterface $encoder
     * @param UserRepository $userRepository
     * @param PetshopSizeRepository $petshopSizeRepository
     * @param PetshopSpeciesRepository $petshopSpeciesRepository
     * @param HorseCoatRepository $horseCoatRepository
     * @param HorseTypeRepository $horseTypeRepository
     * @param HorseSpeciesRepository $horseSpeciesRepository
     * @param ObjectFamilyRepository $objectFamilyRepository
     */
    public function __construct(UserPasswordHasherInterface $encoder,
                                UserRepository $userRepository,
                                PetshopSizeRepository $petshopSizeRepository,
                                PetshopSpeciesRepository $petshopSpeciesRepository,
                                HorseCoatRepository $horseCoatRepository,
                                HorseTypeRepository $horseTypeRepository,
                                HorseSpeciesRepository $horseSpeciesRepository,
                                ObjectFamilyRepository $objectFamilyRepository
                                )
    {
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;
        $this->petshopSizeRepository = $petshopSizeRepository;
        $this->petshopSpeciesRepository = $petshopSpeciesRepository;
        $this->horseCoatRepository = $horseCoatRepository;
        $this->horseTypeRepository = $horseTypeRepository;
        $this->horseSpeciesRepository = $horseSpeciesRepository;
        $this->objectFamilyRepository = $objectFamilyRepository;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $this->makeUsers($faker,$manager);
        $manager->flush();

        $objectFamilyPetshop = new ObjectFamily();
        $objectFamilyPetshop->setName('Petshop');
        $manager->persist($objectFamilyPetshop);
        $objectFamilySchleich = new ObjectFamily();
        $objectFamilySchleich->setName('HorseSchleich');
        $manager->persist($objectFamilySchleich);
        $manager->flush();


        $this->makePetshopSpecies($faker,$manager);
        $manager->flush();
        $this->makePetshopSizes($faker,$manager);
        $manager->flush();
        $this->makePetshops($faker,$manager);
        $manager->flush();

        $this->makeHorseType($faker, $manager);
        $manager->flush();
        $this->makeHorseSpecies($faker, $manager);
        $manager->flush();
        $this->makeHorseCoat($faker, $manager);
        $manager->flush();
        $this->makeHorseSchleiches($faker, $manager);

        $manager->flush();

    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makeUsers(Generator $faker, ObjectManager $manager){
        for ($i = 0 ; $i < 10 ; $i++){
            $user = new User();
            $user->setEmail($faker->unique()->email())
                ->setNickname($faker->unique()->userName())
                ->setAbout($faker->realText)
                ->setRegisteredAt(($faker->dateTimeBetween('- 1 year', '- 1 month')))
                ->setRoles(['ROLE_USER']);
            $password =  $this->encoder->hashPassword($user, $user->getNickname());
            $user->setPassword($password);
            $manager->persist($user);
        }

    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makePetshopSpecies(Generator $faker, ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $species = new PetshopSpecies();
            $species->setName($faker->firstName());
            $manager->persist($species);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makePetshopSizes(Generator $faker, ObjectManager $manager){
        for($i=0;$i<4;$i++){
            $size = new PetshopSize();
            $size->setName($faker->word());
            $manager->persist($size);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makePetshops(Generator $faker, ObjectManager $manager){
        $users = $this->userRepository->findAll();
        $sizes = $this->petshopSizeRepository->findAll();
        $species = $this->petshopSpeciesRepository->findAll();
        $objectFamily = $this->objectFamilyRepository->findOneBy(['name'=>'Petshop']);
        for($i=0;$i<200;$i++){
            $petshop = new Petshop();
            $petshop->setName($faker->firstName())
                ->setBiography($faker->realText())
                ->setUser($faker->randomElement($users))
                ->setSpecies($faker->randomElement($species))
                ->setSize($faker->randomElement($sizes))
                ->setCreatedAt($faker->dateTimeBetween($petshop->getUser()->getRegisteredAt(), 'now'))
                ->setObjectFamily($objectFamily);

            $manager->persist($petshop);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makeHorseSpecies(Generator $faker, ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $species = new HorseSpecies();
            $species->setName($faker->word());
            $manager->persist($species);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makeHorseType(Generator $faker, ObjectManager $manager){
        for($i=0;$i<5;$i++){
            $type = new HorseType();
            $type->setName($faker->word());
            $manager->persist($type);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makeHorseCoat(Generator $faker, ObjectManager $manager){
        for($i=0;$i<5;$i++){
            $coat = new HorseCoat();
            $coat->setName($faker->word());
            $manager->persist($coat);
        }
    }

    /**
     * @param Generator $faker
     * @param ObjectManager $manager
     * @return void
     */
    private function makeHorseSchleiches(Generator $faker, ObjectManager $manager){
        $users = $this->userRepository->findAll();
        $coats = $this->horseCoatRepository->findAll();
        $types = $this->horseTypeRepository->findAll();
        $species = $this->horseSpeciesRepository->findAll();
        $objectFamily = $this->objectFamilyRepository->findOneBy(['name'=>'HorseSchleich']);

        for($i=0;$i<200;$i++){
            $schleich = new HorseSchleich();
            $schleich->setName($faker->firstName())
                ->setBiography($faker->realText())
                ->setUser($faker->randomElement($users))
                ->setSpecies($faker->randomElement($species))
                ->setCoat($faker->randomElement($coats))
                ->setType($faker->randomElement($types))
                ->setCreatedAt($faker->dateTimeBetween($schleich->getUser()->getRegisteredAt(), 'now'))
                ->setObjectFamily($objectFamily);
            $manager->persist($schleich);
        }
    }
}
