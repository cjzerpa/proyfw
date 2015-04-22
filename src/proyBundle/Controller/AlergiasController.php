<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Alergias;
use proyBundle\Form\AlergiasType;

/**
 * Alergias controller.
 *
 * @Route("/alergias")
 */
class AlergiasController extends Controller
{

    /**
     * Lists all Alergias entities.
     *
     * @Route("/", name="alergias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Alergias')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Alergias entity.
     *
     * @Route("/", name="alergias_create")
     * @Method("POST")
     * @Template("proyBundle:Alergias:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Alergias();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alergias_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Alergias entity.
     *
     * @param Alergias $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Alergias $entity)
    {
        $form = $this->createForm(new AlergiasType(), $entity, array(
            'action' => $this->generateUrl('alergias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Alergias entity.
     *
     * @Route("/new", name="alergias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Alergias();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Alergias entity.
     *
     * @Route("/{id}", name="alergias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Alergias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alergias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Alergias entity.
     *
     * @Route("/{id}/edit", name="alergias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Alergias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alergias entity.');
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
    * Creates a form to edit a Alergias entity.
    *
    * @param Alergias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Alergias $entity)
    {
        $form = $this->createForm(new AlergiasType(), $entity, array(
            'action' => $this->generateUrl('alergias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Alergias entity.
     *
     * @Route("/{id}", name="alergias_update")
     * @Method("PUT")
     * @Template("proyBundle:Alergias:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Alergias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alergias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('alergias_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Alergias entity.
     *
     * @Route("/{id}", name="alergias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Alergias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alergias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alergias'));
    }

    /**
     * Creates a form to delete a Alergias entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alergias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar alergias', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }
}
