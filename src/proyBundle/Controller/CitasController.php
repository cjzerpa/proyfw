<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Citas;
use proyBundle\Form\CitasType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Citas controller.
 * @Route("/citas")
 */
class CitasController extends Controller
{

    /**
     * Lists all Citas entities.
     *
     * @Route("/", name="citas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Citas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Citas entity.
     *
     * @Route("/", name="citas_create")
     * @Method("POST")
     * @Template("proyBundle:Citas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Citas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('citas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Citas entity.
     *
     * @param Citas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Citas $entity)
    {
        $form = $this->createForm(new CitasType(), $entity, array(
            'action' => $this->generateUrl('citas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Citas entity.
     *
     * @Route("/new", name="citas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Citas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Citas entity.
     *
     * @Route("/{id}", name="citas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Citas entity.
     *
     * @Route("/{id}/edit", name="citas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
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
    * Creates a form to edit a Citas entity.
    *
    * @param Citas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Citas $entity)
    {
        $form = $this->createForm(new CitasType(), $entity, array(
            'action' => $this->generateUrl('citas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Citas entity.
     *
     * @Route("/{id}", name="citas_update")
     * @Method("PUT")
     * @Template("proyBundle:Citas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('citas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Citas entity.
     *
     * @Route("/{id}", name="citas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Citas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Citas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('citas'));
    }

    /**
     * Creates a form to delete a Citas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('citas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Cancelar Cita', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }
}
