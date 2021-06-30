<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['Form_helper', 'File_helper', 'Accountnotice_helper', 'Autopass_helper', 'url', 'StudentSubjects_helper', 'Data_helper'];

	public $session;

    protected $email_subject;
    protected $email_content;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session = session();
	}

	/**
     * Check current session
     */
    protected function hasSession()
    {
		// redirect to login if no session found
		// redirect to verifyAccount page if session not yet verified
		if (!$this->session->has('logged_user')) {
			return redirect()->to(base_url('login'));
		} elseif (!$_SESSION['logged_user']['emailVerified']) {
			return redirect()->to(base_url('verifyAccount'));
		}
    }

	/**
	 * Check Role and redirect somewhere if wrong role
	 */
	protected function role_checking($prohibited_roles = ['1', '2', '3'])
	{
		$role = $_SESSION['logged_user']['role'];

		if (!in_array($role, $prohibited_roles)) {
			return redirect()->to(base_url('dashboard'));
		}
	}
}
