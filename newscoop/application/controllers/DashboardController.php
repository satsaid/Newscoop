<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

use Newscoop\Entity\User;

/**
 */
class DashboardController extends Zend_Controller_Action
{
    /** @var Newscoop\Services\UserService */
    private $service;

    /** @var Newscoop\Entity\User */
    private $user;

    public function init()
    {
        $GLOBALS['controller'] = $this;
        $this->_helper->layout->disableLayout();

        $this->service = $this->_helper->service('user');
        $this->user = $this->service->getCurrentUser();
    }

    public function preDispatch()
    {
        if (empty($this->user)) {
            $this->_helper->redirector('index', 'auth');
        }
    }

    public function indexAction()
    {
        $form = new Application_Form_Profile();
        $form->setMethod('POST');

        $form->setDefaultsFromEntity($this->user);

        $request = $this->getRequest();
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $values = $form->getValues();

            try {
                $imageInfo = array_pop($form->image->getFileInfo());
                if (!empty($values['image'])) {
                    $values['image'] = $this->_helper->service('image')->save($imageInfo);
                }
                $this->service->save($values, $this->user);
                $this->_helper->redirector('index');
            } catch (\InvalidArgumentException $e) {
                $form->image->addError($e->getMessage());
            }
        }

        $this->view->form = $form;
        $this->view->user = new MetaUser($this->user);
    }

    public function followTopicAction()
    {
        $service = $this->_helper->service('user.topic');
        $topic = $service->findTopic($this->_getParam('topic'));
        if (!$topic) {
            $this->_helper->flashMessenger(array('error', "No topic to follow"));
            $this->_helper->redirector('index', 'index', 'default');
        }

        $service = $this->_helper->service('user.topic');
        $service->followTopic($this->user, $topic);

        $this->_helper->flashMessenger("Topic added to followed");
        $this->_helper->redirector->gotoUrl($_SERVER['HTTP_REFERER']);
    }
}
