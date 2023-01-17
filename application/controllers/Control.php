<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
    function __construct(){
        parent::__construct();
    
        $this->mbgs->_setBaseUrl(base_url());
        $_=array();
        $this->dapp=$this->mbgs->_getBasisData();
        $this->_['assets']=$this->mbgs->_getAssetUrl();
        $this->_['code']=$this->mbgs->_backCode($this->enc->encrypt($this->mbgs->_isCode()));
        $this->_=array_merge($this->_,$this->dapp);
        $this->_['param']=null;
        $this->_['pendidikan']='';
        $this->_['qlogin']=true;
        // Deaguru Institute   
    }
    public function index(){
        $publik=$this->qexec->_func('SELECT * FROM public');
        $this->_['html']=_html([
            'ind'=>1,
            "nmFolder"=>'beranda',
            "html"=>_branda($publik),
            "publik"=>$publik
        ]);
        $this->load->view('indexMfc2',$this->_);
		// $this->load->view('indexMfc',$this->_);
    }
    public function dashboard($val){
        // return print_r($val);
        if($val!=null && $val!="null"){
            $baseEND=json_decode((base64_decode($val)));
            // return print_r($baseEND);
            $username   =$baseEND->{'username'};
            $password   =$baseEND->{'password'}; 

            $q="select * from member where 
                UPPER(username)=UPPER('".$username."') and 
                UPPER(password)=UPPER('".$password."')
            ";
            $member=$this->qexec->_func($q);
            
            $sess=array(
                'kdMember'=>$member[0]['kdMember'],
                'nmMember'=>$member[0]['username'],
                'username'=>$member[0]['username'],
                'password'=>$member[0]['password'],
            );
            $this->sess->set_userdata($sess);
            $nama=$member[0]['username'];
        }else{ 
            if($this->sess->kdMember==null) {
                return $this->logout();
            }
            $nama=$this->sess->username;
        }
        $this->_['page']="dashboard";
		$this->load->view('indexMfc',$this->_);
    }
    public function pesan(){
        if($this->sess->kdMember!=null){
            $this->_['page']="pesan";
            $this->load->view('indexMfc',$this->_);
        }else{
            return $this->logout();
        } 
    }

    public function pendidikan(){
        $this->_['qlogin']=false;
        $publik=$this->qexec->_func('SELECT * FROM public');
        $this->_['pendidikan']=json_encode($this->qexec->_func('SELECT * FROM blog where thema="pendidikan"')); 
        $this->_['html']=_html([
            'ind'=>2,
            "nmFolder"=>'pendidikan',
            "html"=>_pendidikan($publik),
            "publik"=>$publik
        ]);
        $this->load->view('indexMfc2',$this->_);
    }
    public function pengembangan(){
        $this->_['qlogin']=false;
        $publik=$this->qexec->_func('SELECT * FROM public');
        $this->_['pendidikan']=json_encode($this->qexec->_func('SELECT * FROM blog where thema="pengembangan"')); 
        $this->_['html']=_html([
            'ind'=>3,
            "nmFolder"=>'pengembangan',
            "html"=>_pengembangan($publik),
            "publik"=>$publik
        ]);
        $this->load->view('indexMfc2',$this->_);
    }
    public function riset(){
        $this->_['qlogin']=false;
        $publik=$this->qexec->_func('SELECT * FROM public');
        $this->_['pendidikan']=json_encode($this->qexec->_func('SELECT * FROM blog where thema="riset"')); 
        $this->_['html']=_html([
            'ind'=>4,
            "nmFolder"=>'riset',
            "html"=>_riset($publik),
            "publik"=>$publik
        ]);
        $this->load->view('indexMfc2',$this->_);
    }

    public function bloger($val){
        $baseEND=json_decode((base64_decode($val)));
        // return print_r($baseEND);
        $kdBlog     =$baseEND->{'kdBlog'};
        $thema      =$baseEND->{'thema'}; 
        $publik=$this->qexec->_func('SELECT * FROM public');
        $blog=$this->qexec->_func('SELECT * FROM blog where thema="'.$thema.'" and kdBlog="'.$kdBlog.'"')[0]; 
        // return print_r($blog);
        $this->_['html']=_html([
            'ind'=>3,
            "nmFolder"=>$thema,
            "html"=>_blog($blog),
            "publik"=>$publik
        ]);
        $this->load->view('indexMfc2',$this->_);
    }
    public function akun(){
        // $portal=$this->_keamanan(_getNKA("p-usu".$this->sess->tahapan,false));
        if($this->sess->kdMember!=null){
            $this->_['page']="akun";
            $this->load->view('indexMfc',$this->_);
        }else{
            return $this->logout();
        } 
    }
    public function blog(){
        if($this->sess->kdMember!=null){
            $this->_['page']="blog";
		    $this->load->view('indexMfc',$this->_);
        }else{
            return $this->logout();
        } 
    }
    public function respon($val){
        $portal=$this->_keamanan(_getNKA("p-resp",false));
        if($portal['exec']){
            $this->_['page']="respon";
            $this->_['param']=$val;
		    $this->load->view('indexMfc',$this->_);
        }else{
            if($portal['msg']=="session"){
                return $this->logout();
            }else{
                return $this->dashboard("null");
            }
        } 
    }
    public function usulanPembahasan($val){
        $this->sess->tahun=$val;
        $portal=$this->_keamanan(_getNKA("p-usu".$this->sess->tahapan,false));
        if($portal['exec']){
            $this->_['page']="usulanPembahasan";
            $this->_['param']=$val;
            $this->load->view('indexMfc',$this->_);
        }else{
            if($portal['msg']=="session"){
                return $this->logout();
            }else{
                return $this->dashboard("null");
            }
        } 
    }
    
    public function logout(){
        $this->sess->sess_destroy();
        // header("Location: https://bappedalitbangksb.com");
        return redirect(base_url());
    }
}
