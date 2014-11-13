<?php

// src/Seb/ChatBundle/Ajax/SebAjax.php

namespace Seb\ChatBundle\Ajax;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Seb\ChatBundle\Entity\Message;
use Doctrine\ORM\EntityManager;

/**
 * @toDo: mieux gérer $params
 */
class SebAjax {

    /**
     * Config des fonctions à appeler
     * @var array
     */
    protected static $authorized_functions = array('add', 'load');

    /**
     * Constante
     * @ var string
     */
    const MESSAGE = 'message';

    public function __construct(LoggerInterface $logger, EntityManager $entity_manager) {
        $this->logger = $logger;
        $this->manager = $entity_manager;
    }

    /**
     * Traitement sur la BD en fonction de la fonction passée en paramètre
     * @param array $params
     * @return type
     */
    public function processAjax($params) {
        $function = $params[1];

        // On verifie la validité de la fonction
        if (!$this->isFunctionAuthorized($function)) {
            $this->logger->debug("Fonction non authorisee ($function).");
            return;
        }

        $method = self::MESSAGE . ucfirst($function);
        $this->logger->info("Appel de la méthode: $method");

        return $this->$method($params);
    }

    /**
     * Ajout du message dans la BDD
     * @param type $message
     */
    protected function messageAdd($params) {

        $message = $params[0];
        $sender = $params[2];
        $receiver = $params[3];


        $message_bd = new Message();

        $message_bd->setTimeStamp(new \DateTime("now"));
        $message_bd->setContent($message);
        $message_bd->setIdReceiver($receiver); // Temporaire
        $message_bd->setIdSender($sender);   // Temporaire
        $message_bd->setPending(false);

        $this->manager->persist($message_bd);
        $this->manager->flush();

        return json_encode($message_bd->getId());
    }

    /**
     * Load des messages
     * @alpha On charge juste le dernier message
     * @param type $params
     * @todo Chargé les bons messages, en fonction du dest
     */
    protected function messageLoad($params) {

        $messages_text = array();
        $pending = 'pending'.$params[0];
        
        $this->logger->info("Appel de message load.");
        $rep = $this->manager->getRepository('SebChatBundle:Message');
        $messages = $rep->findBy(array($pending => false), array('id' => 'asc'));
        foreach ($messages as $message) {

            if($this->isImageLike($message->getContent())) {
                $messages_text[] = $this->setImage($message->getContent());
            } else {
                $messages_text[] = $message->getContent();
            }
            
            $setterPending = 'setPending'.$params[0];
            $message->$setterPending(true);
            
            $this->manager->persist($message);
            $this->manager->flush();
        }

        return $messages_text;
    }

    /**
     * Retourne vrai si la fonction passée en paramètre est valide
     * @param string $function
     * @return bool
     */
    private function isFunctionAuthorized($function) {
        return in_array($function, self::$authorized_functions);
    }

    /**
     * Retourne vrai si content est une image (*.jpg) ou un .gif
     * @todo  Améliorer la robustesse de la regex
     * @param string$content
     */
    private function isImageLike($content) {
        return preg_match('#(.)+\.(gif|jpg)$#', $content) == 1;
    }

    /**
     * Ajoute les balise nécessaire si on envoyé une image/gif
     * @todo gif en option
     * @param type $content
     * @return type
     */
    private function setImage($content, $gif = true) {
        return $content_format = '<img src="' . $content . '" "alt="img" class="img" />';
    }

}
