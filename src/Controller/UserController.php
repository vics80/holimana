<?php

namespace App\Controller;

use function Couchbase\defaultDecoder;
use Doctrine\ORM\EntityManager;
use Holimana\Application\Command\User\CreateUser;
use Holimana\Application\Command\User\FindUser;
use Holimana\Application\Command\User\ListUsers;
use Holimana\Application\Command\User\UpdateUser;
use Holimana\Domain\DomainEventPublisher;
use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\Event\DomainEventSubscriber;
use Holimana\Domain\Event\EventPublisher;
use Holimana\Domain\PersistDomainEventSubscriber;
use Holimana\Domain\User\User;
use App\Form\UserType;
use Holimana\Domain\User\UserFactory;
use Holimana\Domain\User\UserId;
use Holimana\Domain\User\UserIdFactory;
use Holimana\Domain\User\UserInvalidArgumentsException;
use Holimana\Infrastructure\Application\DoctrineEventStore;
use Holimana\Infrastructure\Persistence\Doctrine\Repository\DoctrineUserRepository;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends BaseController
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(): Response
    {
        $users = $this->commandBus->handle(new ListUsers('vigarcia@leadtech.com'));
        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/new", name="user_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        $logger = new Logger('testing logger');
        $logger->pushHandler(new StreamHandler('/var/www/holimana/var/log/test.log', Logger::DEBUG));
        $logger->debug('This is a test');


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->handle(
                    new CreateUser(
                        new UserId(),
                        $form->get('firstname')->getdata(),
                        $form->get('lastname')->getData(),
                        $form->get('email')->getData(),
                        $form->get('password')->getData(),
                        $form->get('role')->getData()
                    )
                );

                return $this->redirectToRoute('user_index');
            } catch (UserInvalidArgumentsException $e) {
                $form->get('email')->addError(new FormError('Non valid email'));
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show($id): Response
    {
        $user = $this->commandBus->handle(new FindUser(new UserId($id)));
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, $id): Response
    {
        $user = $this->commandBus->handle(new FindUser(new UserId($id)));

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle(new UpdateUser(
                $user->id(),
                $form->get('firstname')->getData(),
                $form->get('lastname')->getData(),
                $form->get('email')->getData(),
                $form->get('password')->getData(),
                $user
            ));

            return $this->redirectToRoute('user_edit', ['id' => $user->id()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}