<?php

/**
 * @todo: comptage des albums plus propre (utiliser un compteur + entité avec des méta données)
 */

namespace Seb\Bundle\TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Seb\Bundle\TrackerBundle\Entity\Tracker\Tracked;
use Seb\Bundle\TrackerBundle\Entity\Tracker\Music;

class DefaultController extends Controller {

    public function indexAction() {
        // On recupère les élements suivis
        $repo = $this->getDoctrine()->getRepository('SebTrackerBundle:Tracker\Tracked');
        $items = $repo->findAll();



        // Formulaire
        return $this->render('SebTrackerBundle:Default:index.html.twig', array('items' => $items));
    }

    public function ajouterAction() {

        $tracked = new Tracked();
        $form_builder = $this->createFormBuilder($tracked);
        $form_builder
                ->add('date_release', 'date')
                ->add('name', 'text')
                ->add('description', 'text')
                ->add('type', 'text');

        $form = $form_builder->getForm();

        // On recupère la requete
        $request = $this->get('request');

        // Si on a ajouté un élement
        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                // Ajout de l'item dans la BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($tracked);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('seb_tracker'));
        }

        // Formulaire
        return $this->render('SebTrackerBundle:Default:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function musicAction() {

        // On recupère les albums
        $repo = $this->getDoctrine()->getRepository('SebTrackerBundle:Tracker\Music');
        $items = $repo->findAll();
        $toto = $repo->findByListened(true);

        // Affichage
        return $this->render('SebTrackerBundle:Default:music_list.html.twig', array('items' => $items,
                    'items_count' => count($items),
                    'items_not_listened' => count($toto))
        );
    }

    public function musicUpdateAction() {

        // On recupère la requete
        $request = $this->get('request');

        // Si on a ajouté un élement
        if ($request->getMethod() == 'POST') {

            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $album = $em->getRepository('SebTrackerBundle:Tracker\Music')->find($id);

            if (!$album) {
                throw $this->createNotFoundException(
                        'Aucun produit trouvé pour cet id : ' . $id
                );
            }

            $album->setListened(true);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seb_tracker_music'));
    }

    public function musicAddAction() {

        $album = new Music();
        $form_builder = $this->createFormBuilder($album);
        $form_builder
                ->add('name', 'text')
                ->add('artist', 'text')
                ->add('year', 'text');

        $form = $form_builder->getForm();

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                // Ajout de l'item dans la BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('seb_tracker_music'));
        }

        // Formulaire
        return $this->render('SebTrackerBundle:Default:ajouter_music.html.twig', array('form' => $form->createView()));
    }

}
