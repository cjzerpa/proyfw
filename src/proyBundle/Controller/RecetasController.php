<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Recetas;
use proyBundle\Form\RecetasType;

/**
 * Recetas controller.
 *
 * @Route("/recetas")
 */
class RecetasController extends Controller
{

    /**
     * Lists all Recetas entities.
     *
     * @Route("/", name="recetas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Recetas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Recetas entity.
     *
     * @Route("/", name="recetas_create")
     * @Method("POST")
     * @Template("proyBundle:Recetas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Recetas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recetas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Recetas entity.
     *
     * @param Recetas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Recetas $entity)
    {
        $form = $this->createForm(new RecetasType(), $entity, array(
            'action' => $this->generateUrl('recetas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Recetas entity.
     *
     * @Route("/new", name="recetas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Recetas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Recetas entity.
     *
     * @Route("/{id}", name="recetas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Recetas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recetas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Recetas entity.
     *
     * @Route("/{id}/edit", name="recetas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Recetas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recetas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Recetas entity.
    *
    * @param Recetas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recetas $entity)
    {
        $form = $this->createForm(new RecetasType(), $entity, array(
            'action' => $this->generateUrl('recetas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Recetas entity.
     *
     * @Route("/{id}", name="recetas_update")
     * @Method("PUT")
     * @Template("proyBundle:Recetas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Recetas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recetas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recetas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Recetas entity.
     *
     * @Route("/{id}", name="recetas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Recetas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recetas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recetas'));
    }

    /**
     * Creates a form to delete a Recetas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recetas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar receta', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')))
            ->getForm()
        ;
    }
}
