<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\ContactoEmergencia;
use proyBundle\Form\ContactoEmergenciaType;

/**
 * ContactoEmergencia controller.
 *
 * @Route("/contactoemergencia")
 */
class ContactoEmergenciaController extends Controller
{

    /**
     * Lists all ContactoEmergencia entities.
     *
     * @Route("/", name="contactoemergencia")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:ContactoEmergencia')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ContactoEmergencia entity.
     *
     * @Route("/", name="contactoemergencia_create")
     * @Method("POST")
     * @Template("proyBundle:ContactoEmergencia:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ContactoEmergencia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paciente_show', array('id' => $entity->getPaciente()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ContactoEmergencia entity.
     *
     * @param ContactoEmergencia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ContactoEmergencia $entity)
    {
        $form = $this->createForm(new ContactoEmergenciaType(), $entity, array(
            'action' => $this->generateUrl('contactoemergencia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new ContactoEmergencia entity.
     *
     * @Route("/new", name="contactoemergencia_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ContactoEmergencia();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ContactoEmergencia entity.
     *
     * @Route("/{id}", name="contactoemergencia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:ContactoEmergencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactoEmergencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ContactoEmergencia entity.
     *
     * @Route("/{id}/edit", name="contactoemergencia_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:ContactoEmergencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactoEmergencia entity.');
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
    * Creates a form to edit a ContactoEmergencia entity.
    *
    * @param ContactoEmergencia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ContactoEmergencia $entity)
    {
        $form = $this->createForm(new ContactoEmergenciaType(), $entity, array(
            'action' => $this->generateUrl('contactoemergencia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing ContactoEmergencia entity.
     *
     * @Route("/{id}", name="contactoemergencia_update")
     * @Method("PUT")
     * @Template("proyBundle:ContactoEmergencia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:ContactoEmergencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactoEmergencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contactoemergencia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ContactoEmergencia entity.
     *
     * @Route("/{id}", name="contactoemergencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:ContactoEmergencia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ContactoEmergencia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contactoemergencia'));
    }

    /**
     * Creates a form to delete a ContactoEmergencia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactoemergencia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar contacto', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }

    
}
