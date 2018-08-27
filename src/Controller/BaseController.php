<?php

namespace App\Controller;

//use Itv\Infrastructure\Validator\ValidatorService;
use League\Tactician\CommandBus;
//use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Translation\TranslatorInterface;

class BaseController extends Controller
{
    /**
     * @var CommandBus
     */
    protected $commandBus;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var ValidatorService
     */
    protected $validator;
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(
        CommandBus $commandBus
//        LoggerInterface $logger,
//        ValidatorService $validator,
//        TranslatorInterface $translator
    )
    {
        $this->commandBus = $commandBus;
//        $this->logger = $logger;
//        $this->validator = $validator;
//        $this->translator = $translator;
    }
}