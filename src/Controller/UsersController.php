<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\QuizzRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $manager,
        private UserRepository $userRepo,
        private UserPasswordHasherInterface $passwordHasher,
        private CategoryRepository $categoryRepo,
        private QuizzRepository $quizzRepo
    ) {    
    }
    
    
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        $myQuizzes = $this->quizzRepo->findBy(['createdBy' => $this->getUser()]);
        $myCategories = $this->categoryRepo->findBy(['createdBy' => $this->getUser()]);
        
        return $this->render('users/profile.html.twig', [
            'user' => $this->getUser(),
            'quizzes' => $myQuizzes,
            'categories' => $myCategories,
        ]);
    }
    
    #[Route('/login', name: 'login')]
    public function index(): Response
    {
        $this->CheckUserInDatabase();
        $currentUser = $this->getUser();
        // Si l'user est déjà connecté
        if (!empty($currentUser)){
            return $this->redirectToRoute('app_home');
        }
        $this->addFlash("danger", "Les informations de connexion ne sont pas valides");
        return $this->render('users/login.html.twig', [
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        
    }

    public function CheckUserInDatabase()
    {
        $userList = $this->userRepo->findAll();
        //S'il n'y a pas d'users
        if($userList == null){
            $user = new User();
            $user->setFirstname("Tanguy");
            $user->setLastname("Baldewyns");  
            $user->setEmail("tanguy.baldewyns@gmail.com");
            $hashedPassword = $this->passwordHasher->hashPassword($user,"aaaaaa");
            $user->setPassword($hashedPassword);
            $user->setCreatedAt(new DateTime('Europe/Paris'));
            $user->setAccountType("ROLE_ADMIN");
            $this->manager->getManager()->persist($user);
            //Envoie des données vers la base de données
            $this->manager->getManager()->flush(); 
        }
    }
}
