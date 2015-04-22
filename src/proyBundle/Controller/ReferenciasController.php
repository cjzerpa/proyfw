<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Referencias;
use proyBundle\Form\ReferenciasType;

/**
 * Referencias controller.
 *
 * @Route("/referencias")
 */
class ReferenciasController extends Controller
{

    /**
     * Lists all Referencias entities.
     *
     * @Route("/", name="referencias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Referencias')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Referencias entity.
     *
     * @Route("/", name="referencias_create")
     * @Method("POST")
     * @Template("proyBundle:Referencias:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Referencias();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referencias_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Referencias entity.
     *
     * @param Referencias $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Referencias $entity)
    {
        $form = $this->createForm(new ReferenciasType(), $entity, array(
            'action' => $this->generateUrl('referencias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Referencias entity.
     *
     * @Route("/new", name="referencias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Referencias();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Referencias entity.
     *
     * @Route("/{id}", name="referencias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Referencias entity.
     *
     * @Route("/{id}/edit", name="referencias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencias entity.');
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
    * Creates a form to edit a Referencias entity.
    *
    * @param Referencias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Referencias $entity)
    {
        $form = $this->createForm(new ReferenciasType(), $entity, array(
            'action' => $this->generateUrl('referencias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Referencias entity.
     *
     * @Route("/{id}", name="referencias_update")
     * @Method("PUT")
     * @Template("proyBundle:Referencias:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('referencias_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Referencias entity.
     *
     * @Route("/{id}", name="referencias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Referencias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Referencias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('referencias'));
    }

    /**
     * Creates a form to delete a Referencias entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('referencias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar referencia', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')))
            ->getForm()
        ;
    }
}
