<?php

namespace proyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use proyBundle\Entity\Medicamentos;
use proyBundle\Form\MedicamentosType;

/**
 * Medicamentos controller.
 *
 * @Route("/medicamentos")
 */
class MedicamentosController extends Controller
{

    /**
     * Lists all Medicamentos entities.
     *
     * @Route("/", name="medicamentos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('proyBundle:Medicamentos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Medicamentos entity.
     *
     * @Route("/", name="medicamentos_create")
     * @Method("POST")
     * @Template("proyBundle:Medicamentos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Medicamentos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('medicamentos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Medicamentos entity.
     *
     * @param Medicamentos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Medicamentos $entity)
    {
        $form = $this->createForm(new MedicamentosType(), $entity, array(
            'action' => $this->generateUrl('medicamentos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }

    /**
     * Displays a form to create a new Medicamentos entity.
     *
     * @Route("/new", name="medicamentos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Medicamentos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Medicamentos entity.
     *
     * @Route("/{id}/edit", name="medicamentos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
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
    * Creates a form to edit a Medicamentos entity.
    *
    * @param Medicamentos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Medicamentos $entity)
    {
        $form = $this->createForm(new MedicamentosType(), $entity, array(
            'action' => $this->generateUrl('medicamentos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr'=>array('class'=>'btn btn-primary entity-submit pull-left')));

        return $form;
    }
    /**
     * Edits an existing Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_update")
     * @Method("PUT")
     * @Template("proyBundle:Medicamentos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('proyBundle:Medicamentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('medicamentos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Medicamentos entity.
     *
     * @Route("/{id}", name="medicamentos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('proyBundle:Medicamentos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Medicamentos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medicamentos'));
    }

    /**
     * Creates a form to delete a Medicamentos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicamentos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar Medicamento', 'attr'=>array('class'=>'btn btn-warning entity-submit pull-left')))
            ->getForm()
        ;
    }
}
