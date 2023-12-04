<?php

namespace App\Bundle\SecurityBundle\Command;

use App\Bundle\SecurityBundle\Entity\Administrator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'security:create-admin',
    description: 'Create new user Administrator - { params: name - email - password }!',
)]
class RecoverPasswordAdministratorCommand extends Command
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected UserPasswordHasherInterface $passwordHasher,
        string $name = null,
    )
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Name the Administrator!')
            ->addArgument('email', InputArgument::REQUIRED, 'Email the Administrator')
            ->addArgument('password', InputArgument::REQUIRED, 'Password the Administrator')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $email = $input->getArgument('email');
        $senha = $input->getArgument('password');

        if (!$name) {
            $io->note(sprintf('Enter the name!'));
            exit;
        }

        if (!$email) {
            $io->note(sprintf('Enter the email!'));
            exit;
        }

        if (!$senha) {
            $io->note(sprintf('Enter the password!'));
            exit;
        }

        $em = $this->entityManager;

        $user = $em->getRepository(Administrator::class)->findOneBy(['email'=>$email]);
        if($user){
            $io->note(sprintf('Email already registered in the system!'));
            exit;
        }

        $user = new Administrator();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $senha));
        $user->setRoles(['ROLE_SUPER_ADMIN']);

        $em->persist($user);
        $em->flush();

        $io->success('Registration carried out!');

        return Command::SUCCESS;
    }
}
