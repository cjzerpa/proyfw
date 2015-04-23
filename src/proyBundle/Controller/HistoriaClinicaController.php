<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\HistoriaClinica;
use proyBundle\Entity\Medicamentos;
use proyBundle\Entity\Alergias;
use proyBundle\Form\HistoriaClinicaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * HistoriaClinica controller.
 * @Route("/historiaclinica")
 */
class HistoriaClinicaController extends Controller
{

    /**
     * Lists all HistoriaClinica entities.
     *
     * @Route("/", name="historiaclinica")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:HistoriaClinica')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new HistoriaClinica entity.
     *
     * @Route("/", name="historiaclinica_create")
     * @Method("POST")
     * @Template("proyBundle:HistoriaClinica:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new HistoriaClinica();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('historiaclinica_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a HistoriaClinica entity.
     *
     * @param HistoriaClinica $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(HistoriaClinica $entity)
    {
        $form = $this->createForm(new HistoriaClinicaType(), $entity, array(
            'action' => $this->generateUrl('historiaclinica_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new HistoriaClinica entity.
     *
     * @Route("/new", name="historiaclinica_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {

        $entity = new HistoriaClinica();

        $medicamentos1= new Medicamentos();
        $medicamentos1->name='medicamentos1';
        $alergias1= new Alergias();
        $alergias1->name='alergias1';
        $entity->getMedicamentos()->add($medicamentos1);
        $entity->getAlergias()->add($alergias1);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a HistoriaClinica entity.
     *
     * @Route("/{id}", name="historiaclinica_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:HistoriaClinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistoriaClinica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing HistoriaClinica entity.
     *
     * @Route("/{id}/edit", name="historiaclinica_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:HistoriaClinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistoriaClinica entity.');
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
    * Creates a form to edit a HistoriaClinica entity.
    *
    * @param HistoriaClinica $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HistoriaClinica $entity)
    {
        $form = $this->createForm(new HistoriaClinicaType(), $entity, array(
            'action' => $this->generateUrl('historiaclinica_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing HistoriaClinica entity.
     *
     * @Route("/{id}", name="historiaclinica_update")
     * @Method("PUT")
     * @Template("proyBundle:HistoriaClinica:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:HistoriaClinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistoriaClinica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('historiaclinica_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a HistoriaClinica entity.
     *
     * @Route("/{id}", name="historiaclinica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:HistoriaClinica')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HistoriaClinica entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('historiaclinica'));
    }

    /**
     * Creates a form to delete a HistoriaClinica entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('historiaclinica_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar Historia', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }
}
