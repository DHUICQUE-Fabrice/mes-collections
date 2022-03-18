<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    protected static $defaultDescription = 'Create user admin';
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param string|null $name
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository, string $name = null)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;

        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email of user')
            ->addArgument('password', InputArgument::REQUIRED, 'Password of user')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $helper = $this->getHelper('question');

        $questionNickname = new Question('- What is nickname ? ');
        $responseNickname = $helper->ask($input, $output, $questionNickname);


        $io->note('Summary : ');
        $io->writeln(sprintf('- Your password : %s', $password));
        $io->writeln(sprintf('- Your email : %s', $email));
        $io->writeln(sprintf('- Your nickname : %s', $responseNickname));

        $io->newLine();
        $question = new ConfirmationQuestion('Are you sure ? [Y|n] : ', false);
        $question->setAutocompleterValues([true, false]);

        if (!$helper->ask($input, $output, $question)) {
            $io->newLine();
            $io->error('Retry !');
            return Command::FAILURE;
        }

        if ($this->userRepository->findOneBy(['email' => $email])) {
            $io->newLine();
            $io->error('User exist.');
            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setNickname($responseNickname);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->newLine();
        $io->success('User create Admin');

        return Command::SUCCESS;
    }
}
