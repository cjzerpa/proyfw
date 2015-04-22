<?php

namespace Zenva\WorkoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zenva\WorkoutBundle\Entity\Workaout;
use Zenva\WorkoutBundle\Form\WorkaoutType;

/**
 * Workaout controller.
 *
 * @Route("/workaout")
 */
class WorkaoutController extends Controller
{

    /**
     * Lists all Workaout entities.
     *
     * @Route("/", name="workaout")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZenvaWorkoutBundle:Workaout')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Workaout entity.
     *
     * @Route("/", name="workaout_create")
     * @Method("POST")
     * @Template("ZenvaWorkoutBundle:Workaout:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Workaout();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('workaout_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Workaout entity.
     *
     * @param Workaout $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Workaout $entity)
    {
        $form = $this->createForm(new WorkaoutType(), $entity, array(
            'action' => $this->generateUrl('workaout_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Workaout entity.
     *
     * @Route("/new", name="workaout_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Workaout();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Workaout entity.
     *
     * @Route("/{id}", name="workaout_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZenvaWorkoutBundle:Workaout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workaout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Workaout entity.
     *
     * @Route("/{id}/edit", name="workaout_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZenvaWorkoutBundle:Workaout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workaout entity.');
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
    * Creates a form to edit a Workaout entity.
    *
    * @param Workaout $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Workaout $entity)
    {
        $form = $this->createForm(new WorkaoutType(), $entity, array(
            'action' => $this->generateUrl('workaout_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Workaout entity.
     *
     * @Route("/{id}", name="workaout_update")
     * @Method("PUT")
     * @Template("ZenvaWorkoutBundle:Workaout:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZenvaWorkoutBundle:Workaout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workaout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('workaout_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Workaout entity.
     *
     * @Route("/{id}", name="workaout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZenvaWorkoutBundle:Workaout')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Workaout entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('workaout'));
    }

    /**
     * Creates a form to delete a Workaout entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('workaout_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
