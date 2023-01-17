<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WsKomponen extends CI_Controller {
    function __construct(){
        parent::__construct();	
        // $this->load->helper('url','html_helper','mbgs_helper');

        $this->mbgs->_setBaseUrl(base_url());
        
        $_=array();
        $this->dapp=$this->mbgs->_getBasisData();
        $this->_['code']=$this->mbgs->_backCode($this->enc->encrypt($this->mbgs->_isCode()));
        $this->_=array_merge($this->_,$this->dapp); 

        // $username=$this->sess->username;
        // $password=$this->sess->password;
        // $this->startLokal();
    }
    function startLokal(){
        $res=$this->mbgs->_getAllFile("/fs_sistem/session");
        $data="";
        foreach ($res as $key => $value) {
            $exp=explode($this->mbgs->_getIpClient()."=",$value['nama']);
            if(count($exp)>1){
                $data=$this->mbgs->_readFileTxt($value['file']);
            }
        }
        if(strlen($data)==0){
            return $this->mbgs->resF("session");
        }
        $data=json_decode($data);
        $session=array(
            'kdMember'=>$data->{'kdMember'},
            'nmMember'=>$data->{'nmMember'},
            'kdJabatan'=>$data->{'kdJabatan'},
            'kdKantor'=>$data->{'kdKantor'},
            'nmKantor'=>$data->{'nmKantor'},
            'username'=>$data->{'username'},
            'password'=>$data->{'password'},
        );
        $this->sess->set_userdata($session);
        $this->kdMember=$this->sess->kdMember;
        $this->kdMember1=$this->sess->kdMember1;
        $this->nmMember=$this->sess->nmMember;
        $this->kdJabatan=$this->sess->kdJabatan;
        $this->kdKantor=$this->sess->kdKantor;
        $this->nmKantor=$this->sess->nmKantor;
    }
    function dashboard($page){
        
        $this->_['head']    =$this->mbgs->_getJsMaster($page);  
        $this->_['publik']  =$this->qexec->_func('SELECT * FROM public');
        return print_r(json_encode($this->_));
    }
    function akun($page){
        $this->_['head']=$this->mbgs->_getJsMaster($page);
        return print_r(json_encode($this->_));
    }
    function blog($page){
        $this->_['head']=$this->mbgs->_getJsMaster($page);
        $this->_['pendidikan']=$this->qexec->_func('SELECT * FROM blog where thema="pendidikan"');
        return print_r(json_encode($this->_));
    }
    function pesan($page){
        
        $this->_['head']    =$this->mbgs->_getJsMaster($page);  
        $this->_['pesan']  =$this->qexec->_func('SELECT * FROM komunikasi order by time desc');
        return print_r(json_encode($this->_));
    }
    
    
    function getKeyAct($obj,$dkey){
        $key=$this->qexec->_func(
            _groupKey(
                _getNKA($obj,false),
                $this->sess->kdMember1,
                $this->sess->tahun,
                $this->dapp['kd']
            )
        );
        foreach ($dkey as $i => $v) {
            foreach ($key as $i1 => $v1) {
                if($v==$v1['kdFitur']){
                    $dkey[$i]=$v1['kunci'];
                }
            }
            if(strlen($dkey[$i])>1){ // jika tidak berubah berarti tidak memiliki akses
                $dkey[$i]=1;
            }
        }
        return $dkey;
    }
}
