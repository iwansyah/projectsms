<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
        
        //main page load
	
	public function loadPage($fil,$dir=null,$data=null)
	{
		$data['load'] = $fil;
		$data['dir'] = $dir;
                $data['folder'] = $this->folMenu();
		$this->load->view('index.php',$data);	
	}
	
	//input post
	public function ipost($val)
	{
		return $this->input->post($val);
	}
	
	//input get
	public function iget($val)
	{
		return $this->input->get($val);
	}
        
        public function iseg($val)
        {
                return $this->uri->segment($val);
        }
        
        public function ises($val)
        {
                return $this->session->set_userdata($val);
        }
        
        public function cises($val)
        {
                return $this->session->userdata($val);
        }
        
        public function sesid(){
                return $this->cises('id');
        }
        
        public function folMenu(){
            $this->load->model('dbase');
            $id = $this->cises('id');
            $whr = array('user_id'=>$id);
            $query = $this->dbase->getdata('*','folder',$whr);
            return $query;
        }
        
        ######################### access control ##########################3
        
        public function access(){
            $myakses = $this->cises('akses');
            $q = $this->dbase->getJoin('*','akses_menu','menu',"akses_menu.id_m=menu.id_m and id_akses = '".$myakses."'");
            $menu = array();
            foreach($q->result() as $r){
                $menu[$r->menu] = $r->fitur;
            }
            return $menu;
        }
        
        public function level(){
            #fitur 6 can be access all => admin
            //action index, add, edit, delete, cari
            #fitur 4 can be access home, sms, draf, folder , kontak, cari, profile => user
            //action index, add, edit, cari
            #fitur 2 can be access home, sms => guest
            //action index, add
            $menu = $this->access();
            #print_r($menu);
            
            ################### if not login in #################
            $login = array(6,4,2);
            if(count($menu)>0){
                if(!in_array($menu[$this->iseg(1)],$login)){
                    echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                    exit;
                }
            }
            else{
                    echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                    exit;
            }
            #####################################################
            
            ######### admin only can be access ##################
            $admin_array = array('gammu','user');
            if(in_array($this->iseg(1),$admin_array)){
                if($menu[$this->iseg(1)] !== '6'){
                    echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                    exit;
                }
            }
            if($this->iseg(1) === 'setting'){
                if($this->iseg(2) === 'akses' || $this->iseg(2) === 'aksesMenu'){
                    if($menu['akses'] !== '6'){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;
                    }
                }
            }
            if($menu['setting'] === '6'){
                if($menu['gammu'] === '6' || $menu['user'] === '6'){
                    $data['menus'] = 'show';
                }
            }
            #######################################################
            
            ######### guest only can be access #####################
            $guest_array = array('sms','home');
            if(in_array($this->iseg(1),$guest_array)){
                if($menu[$this->iseg(1)] === '2' && ($this->iseg(2) === '' && $this->iseg(2) === 'index')){
                    echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                    exit;
                }
            }
            ########################################################
            
            ############ user and guest can be control #######################
            $user_array = array('kontak','kontakGroup','folder','draf','home','sms');
            if(in_array($this->iseg(1),$user_array)){
                ######### CRUD access ###############################
                $haki = array(6,4,2);
                $hakc = array(6,4);
                
                $usarr = array('index','');
                if(in_array($this->iseg(2), $usarr)){
                    if(!in_array($menu[$this->iseg(1)],$haki)){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;
                    }
                }
                if($this->iseg(2) === 'addData'){
                    if(!in_array($menu[$this->iseg(1)],$haki)){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;
                    }
                }
                if($this->iseg(2) === 'editData'){
                    if(!in_array($menu[$this->iseg(1)],$hakc)){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;    
                    }
                }
                if($this->iseg(2) === 'deleteData'){
                    if($menu[$this->iseg(1)] !== '6'){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;
                    }
                }
                if($this->iseg(2) === 'cariData'){
                    if(!in_array($menu[$this->iseg(1)],$hakc)){
                        echo"<script type='text/javascript'>alert('Anda tidak bisa mengakses halaman ini...!');history.back();</script>";
                        exit;
                    }
                }
                
            }
            ########################################################
        }
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */