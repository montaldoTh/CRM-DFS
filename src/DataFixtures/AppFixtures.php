<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Customer;
use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@crm.test');
        $user->setPassword($this->hasher->hashPassword($user, 'azerty'));

        $manager->persist($user);

        for ($i=0; $i < 500 ; $i++) { 
            $customer = new Customer();
            $customer->setFirstname('Client-' . $i);
            $customer->setLastname('Doe');
            $customer->setMail('client_' . $i . '@customer.test');
            $customer->setCreatedBy($user);
            
            $manager->persist($customer);
        }

        for ($i=0; $i < 100 ; $i++) { 
            $company = new Company();
            $company->setName('Company-' . $i);
            $company->setSiret('12'. $i . '98' . $i );
            $company->setStreet($i . 'Rue de la company');
            $company->setCity('Ville n°' . $i);
            $company->setZipcode($i . '0000');

            $manager->persist($company);
        }

        $manager->flush();
    }
}