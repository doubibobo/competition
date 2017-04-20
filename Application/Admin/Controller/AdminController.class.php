<?php
	namespace Admin\Controller;
	use Think\Controller;
	class AdminController extends Controller {
		public function index() {
			$this -> redirect("Admin/Admin/login");
		}
		/*
 		 * the login reget of a management
 		 */
	 	public function login() {
	 		
		}
	}