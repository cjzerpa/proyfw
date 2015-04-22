<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\NumerosPaciente;
use proyBundle\Form\NumerosPacienteType;

/**
 * NumerosPaciente controller.
 *
 * @Route("/numerospaciente")
 */
class NumerosPacienteController extends Controller
{

    /**
     * Lists all NumerosPaciente entities.
     *
     * @Route("/", name="numerospaciente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:NumerosPaciente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NumerosPaciente entity.
     *
     * @Route("/", name="numerospaciente_create")
     * @Method("POST")
     * @Template("proyBundle:NumerosPaciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NumerosPaciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('numerospaciente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a NumerosPaciente entity.
     *
     * @param NumerosPaciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(NumerosPaciente $entity)
    {
        $form = $this->createForm(new NumerosPacienteType(), $entity, array(
            'action' => $this->generateUrl('numerospaciente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new NumerosPaciente entity.
     *
     * @Route("/new", name="numerospaciente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NumerosPaciente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NumerosPaciente entity.
     *
     * @Route("/{id}", name="numerospaciente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:NumerosPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NumerosPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NumerosPaciente entity.
     *
     * @Route("/{id}/edit", name="numerospaciente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:NumerosPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NumerosPaciente entity.');
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
    * Creates a form to edit a NumerosPaciente entity.
    *
    * @param NumerosPaciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NumerosPaciente $entity)
    {
        $form = $this->createForm(new NumerosPacienteType(), $entity, array(
            'action' => $this->generateUrl('numerospaciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing NumerosPaciente entity.
     *
     * @Route("/{id}", name="numerospaciente_update")
     * @Method("PUT")
     * @Template("proyBundle:NumerosPaciente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:NumerosPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NumerosPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('numerospaciente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NumerosPaciente entity.
     *
     * @Route("/{id}", name="numerospaciente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:NumerosPaciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NumerosPaciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('numerospaciente'));
    }

    /**
     * Creates a form to delete a NumerosPaciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('numerospaciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar teléfono', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')))
            ->getForm()
        ;
    }
}
