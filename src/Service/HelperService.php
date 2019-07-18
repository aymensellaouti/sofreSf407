<?php


namespace App\Service;

use Psr\Log\LoggerInterface;

class HelperService
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    private $messageAccueil;

    public function __construct(LoggerInterface $logger, $messageAccueil)
    {
        $this->logger = $logger;
        $this->messageAccueil = $messageAccueil;
    }

    public function getRandomString($nb){
        $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $chaine = str_shuffle($char);
        $this->logger->info("La chaine $chaine a été générée");
        $this->logger->info("$this->messageAccueil");
        return substr($chaine,0,$nb);
    }
}