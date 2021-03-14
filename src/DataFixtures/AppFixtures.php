<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Intervenant;
use App\Entity\Matiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /*
    * @var UserPasswordEncoderInterface
    */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        // Modèle User
        for ($i = 1; $i <= 10; $i++) {
            $user = new User;
            $user->setEmail('adresse' . $i . '@caramail.gouv');
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));

            $manager->persist($user);
        }        

        // Modèle Classe
        for ($i = 1; $i <= 4; $i++) {
            $classe = new Classe;
            $classe->setNom('IIM DW' . ($i + 1));
            $classe->setAnneeSortie(2024 - ($i - 1));

            $manager->persist($classe);
        }

        // Modèle Étudiant
        for ($i = 1; $i <= 10; $i++) {
            $etudiant = new Etudiant;
            $etudiant->setClasse($classe);
            $etudiant->setNom('Nom' . $i);
            $etudiant->setPrenom('Prenom' . $i);
            $etudiant->setAge(18 + $i);
            $etudiant->setAnneeArrivee(2008 + $i);

            $manager->persist($etudiant);
        }

        // Modèle Intervenant
        for ($i = 1; $i <= 10; $i++) {
            $intervenant = new Intervenant;
            $intervenant->setNom('Nom' . $i);
            $intervenant->setPrenom('Prenom' . $i);
            $intervenant->setAnneeArrivee(2008 + $i);

            $manager->persist($intervenant);
        }

        // Modèle Matière
        for ($i = 1; $i <= 10; $i++) {
            $matiere = new Matiere;
            $matiere->setIntervenant($intervenant);
            $matiere->setClasse($classe);
            $matiere->setNom('Cours n°' . $i);
            $matiere->setDateDebut(new \DateTime('03/09/2021'));
            $matiere->setDateFin(new \DateTime('08/09/2021'));

            $manager->persist($matiere);
        }

        $manager->flush();
    }
}
