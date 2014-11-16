<?php

// @todo: Catégoris pour le type
// @todo: Table stats + Service pour recup le mois en fonction de la date

namespace Seb\Bundle\CompteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Seb\Bundle\CompteBundle\Entity\Compte\Operation;
use Seb\Bundle\CompteBundle\Entity\Compte\Stats;

class DefaultController extends Controller {

    public function indexAction() {
        // On recupère les opérations
        $repo = $this->getDoctrine()->getRepository('SebCompteBundle:Compte\Operation');
        $items = $repo->findAll();



        // Formulaire ajout operation
        $operation = new Operation();
        $form_builder = $this->createFormBuilder($operation);
        $form_builder
                ->add('date', 'date')
                ->add('Libelle', 'text')
                ->add('Type', 'text')
                ->add('Montant', 'integer')
                ->add('Debit', 'choice', array('choices' => array('1' => 'debit',
                        '0' => 'credit')));

        $form = $form_builder->getForm();
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                // Ajout de l'item dans la BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($operation);
                $em->flush();

                // Update de la table stats
                $date = $operation->getDate();
                $stats = new Stats();
                $mois = $date->format('m');
                $annee = $date->format('Y');
                $montant = $operation->getMontant();
                
                // On regarde si le mois/année existe
                $repo2 = $this->getDoctrine()->getRepository('SebCompteBundle:Compte\Stats');
                $item = $repo2->findOneBy(array('mois' => $mois, 'annee' => $annee));
                
                if (empty($item)) {
                    $stats->setMois($mois);
                    $stats->setAnnee($annee);
                    $stats->setMontant($montant,$operation->getDebit());
                    $em->persist($stats);
                    $em->flush();
                } else {
                    $item->setMontant($montant,$operation->getDebit());
                    $em->flush();
                }
            }
            return $this->redirect($this->generateUrl('seb_compte'));
        }

        return $this->render('SebCompteBundle:Default:index.html.twig', array('operations' => $items,
                    'form' => $form->createView()));
    }

}
