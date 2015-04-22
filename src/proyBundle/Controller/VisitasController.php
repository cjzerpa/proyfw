<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Visitas;
use proyBundle\Entity\Recetas;
use proyBundle\Entity\Referencias;
use proyBundle\Form\VisitasType;

/**
 * Visitas controller.
 *
 * @Route("/visitas")
 */
class VisitasController extends Controller
{

    /**
     * Lists all Visitas entities.
     *
     * @Route("/", name="visitas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Visitas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Visitas entity.
     *
     * @Route("/", name="visitas_create")
     * @Method("POST")
     * @Template("proyBundle:Visitas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Visitas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visitas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Visitas entity.
     *
     * @param Visitas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Visitas $entity)
    {
        $form = $this->createForm(new VisitasType(), $entity, array(
            'action' => $this->generateUrl('visitas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Visitas entity.
     *
     * @Route("/new", name="visitas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Visitas();

        $recetas1= new Recetas();
        $recetas1->name='recetas1';
        $referencias1= new Referencias();
        $referencias1->name='contactosEmergencia1';
        $entity->getRecetas()->add($recetas1);
        $entity->getReferencias()->add($referencias1);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Visitas entity.
     *
     * @Route("/{id}", name="visitas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Visitas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visitas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Visitas entity.
     *
     * @Route("/{id}/edit", name="visitas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Visitas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visitas entity.');
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
    * Creates a form to edit a Visitas entity.
    *
    * @param Visitas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Visitas $entity)
    {
        $form = $this->createForm(new VisitasType(), $entity, array(
            'action' => $this->generateUrl('visitas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Visitas entity.
     *
     * @Route("/{id}", name="visitas_update")
     * @Method("PUT")
     * @Template("proyBundle:Visitas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Visitas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visitas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('visitas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Visitas entity.
     *
     * @Route("/{id}", name="visitas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Visitas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Visitas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('visitas'));
    }

    /**
     * Creates a form to delete a Visitas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('visitas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar visita', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }
}
