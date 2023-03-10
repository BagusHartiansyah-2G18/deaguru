<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// sess enc mbgs lbgs qexec
class Proses extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->mbgs->_setBaseUrl(base_url());
        $this->_=array(); 
    }
	public function checkUser(){
        $kondisi=false;
        if($this->sess->kode==null){
            $data=$_POST['data'];
            if(empty($_POST['data'])){
                return redirect("control");
            }
            $baseEND=json_decode((base64_decode($data)));

            $password   =$baseEND->{'password'};
            $username   =$baseEND->{'username'};
            $kondisi=true;
        }else{
            $password   =$this->sess->password;
            $username   =$this->sess->nama;
        }

        $q="select * from member where UPPER(username)=UPPER('".$username."') and 
            UPPER(password)=UPPER('".$password."')
        "; 
        $member=$this->qexec->_func($q);
        if(count($member)==1){
            return $this->mbgs->resTrue("Sukses");
        }else{
            if($kondisi){//for login awal no sess
                return $this->mbgs->resFalse("user tidak dapat ditemukan !!!");
            }
        }
        print_r(json_encode($this->_));
    }

    public function savePesaPublik(){
        $baseEND=json_decode((base64_decode($_POST['data'])));
        $email   =$baseEND->{'email'};
        $pesan   =$baseEND->{'pesan'};
        $exec=$this->qexec->_proc('INSERT INTO komunikasi(email, pesan) VALUES 
            ('.$this->mbgs->_valforQuery($email).','.$this->mbgs->_valforQuery($pesan).')
        ');
        // return print_r($exec);
        if($exec){
            return $this->mbgs->resTrue($this->_);
        }
        return $this->mbgs->resFalse("Terjadi Kesalahan dalam proses perubahan!!!");
    }

    public function updDataPublik(){
        if($this->sess->kdMember==null){
            return $this->mbgs->resFalse("maaf, Pengguna tidak terdeteksi !!!");
        }else{
            $baseEND=json_decode((base64_decode($_POST['data'])));

            $judul     =$baseEND->{'judul'};
            $isi        =$baseEND->{'isi'};
            $ind        =$baseEND->{'ind'};

            $q="
                UPDATE public set 
                    nama=".$this->mbgs->_valforQuery($judul).",
                    isi=".$this->mbgs->_valforQuery($isi)."
                where ind=".$this->mbgs->_valforQuery($ind)."
            ";
            $check=$this->qexec->_proc($q);
            if($check){
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan dalam proses perubahan!!!");
            }
        }
    }

    function insBlog(){
        // $portal=$this->_keamanan($_POST['code'],_getNKA("c-sett",false));
        // if($portal['exec']){
        if(true){
            $file=$_POST['file'];
            $baseEND=json_decode((base64_decode($_POST['data'])));
            $isi        =$baseEND->{'isi'};
            $judul      =$baseEND->{'judul'};
            $kdBlog     =$baseEND->{'kdBlog'};
            $thema      =$baseEND->{'thema'};
            $namaFile="";
            if(!empty($file)){
                foreach ($file as $key => $v) {
                    if($key>0){
                        $namaFile.="/";
                    }
                    // $namaFile.=$this->_uploadImage($v['src'],$v['nama'])."<2G18>";
                    $namaFile.=$this->_uploadImage($v['src'],"fs_sistem/upload/blog/".$v['nama']);
                }
            }

            $check=$this->qexec->_proc("
                INSERT INTO blog(kdBlog, thema, judul, isi,files) VALUES 
                (
                    ".$this->mbgs->_valforQuery($kdBlog).",".$this->mbgs->_valforQuery($thema).",".$this->mbgs->_valforQuery($judul).",
                    ".$this->mbgs->_valforQuery($isi).",".$this->mbgs->_valforQuery($namaFile)."
                )
            "); 
            if($check){
                $this->_['dt']     =$this->qexec->_func('SELECT * FROM blog where thema="'.$thema.'"');
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan di penyimpanan sistem");
            }
        }
        return $this->mgbs->resFalse($portal['msg']);
    }
    function updBlog(){
        // $portal=$this->_keamanan($_POST['code'],_getNKA("c-sett",false));
        // if($portal['exec']){
        if(true){ 
            $baseEND=json_decode((base64_decode($_POST['data'])));
            $isi        =$baseEND->{'isi'};
            $judul      =$baseEND->{'judul'};
            $kdBlog     =$baseEND->{'kdBlog'};
            $thema      =$baseEND->{'thema'};


            $check=$this->qexec->_proc("
                update blog set judul=".$this->mbgs->_valforQuery($judul).",
                    isi=".$this->mbgs->_valforQuery($isi)."
                where kdBlog=".$this->mbgs->_valforQuery($kdBlog)." and 
                thema=".$this->mbgs->_valforQuery($thema)."
            "); 
            if($check){
                $this->_['dt']     =$this->qexec->_func('SELECT * FROM blog where thema="'.$thema.'"');
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan di penyimpanan sistem");
            }
        }
        return $this->mgbs->resFalse($portal['msg']);
    }
    function delBlog(){
        // $portal=$this->_keamanan($_POST['code'],_getNKA("c-sett",false));
        // if($portal['exec']){
        if(true){ 
            $baseEND=json_decode((base64_decode($_POST['data']))); 
            $kdBlog     =$baseEND->{'kdBlog'};
            $thema      =$baseEND->{'thema'};


            $check=$this->qexec->_proc("
                delete from blog  
                where kdBlog=".$this->mbgs->_valforQuery($kdBlog)." and 
                thema=".$this->mbgs->_valforQuery($thema)."
            "); 
            if($check){
                $this->_['dt']     =$this->qexec->_func('SELECT * FROM blog where thema="'.$thema.'"');
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan di penyimpanan sistem");
            }
        }
        return $this->mgbs->resFalse($portal['msg']);
    }
    function changeThema(){
        // $portal=$this->_keamanan($_POST['code'],_getNKA("c-sett",false));
        // if($portal['exec']){
        if(true){ 
            $baseEND=json_decode((base64_decode($_POST['data'])));  
            $thema      =$baseEND->{'thema'}; 
            $this->_['dt']     =$this->qexec->_func('SELECT * FROM blog where thema="'.$thema.'"');
            return $this->mbgs->resTrue($this->_);
        }
        return $this->mgbs->resFalse($portal['msg']);
    } 
    
    // fitur setting 
    public function updMember(){
        if($this->sess->kdMember==null){
            return $this->mbgs->resFalse("maaf, Pengguna tidak terdeteksi !!!");
        }else{
            $baseEND=json_decode((base64_decode($_POST['data'])));
            $nmMember       =$baseEND->{'nmMember'};
            $password       =$baseEND->{'password'};
            $passwordNew    =$baseEND->{'passwordNew'};
            if($password==$this->sess->password){
                if(strlen($passwordNew)==0){
                    $passwordNew=$password;
                }
                $q="
                    update member set 
                        username=".$this->mbgs->_valforQuery($nmMember).",
                        password=".$this->mbgs->_valforQuery($passwordNew)."
                    where
                        kdMember=".$this->mbgs->_valforQuery($this->sess->kdMember)."
                "; 
                $check=$this->qexec->_proc($q);
                if($check){
                    return $this->mbgs->resTrue($this->_);
                }else{
                    return $this->mbgs->resFalse("Terjadi Kesalahan dalam proses perubahan!!!");
                }
            }else{
                return $this->mbgs->resFalse(" Password yang anda tambahkan tidak sesuai !!!");
            }
            
        }
    }
     
     
    // batas del
    function mengertiInfo(){
        $portal=$this->_keamanan($_POST['code'],$this->mbgs->_getNKA("p-usul"));
        if($portal['exec']){
            $check=$this->qexec->_proc($this->mbgs->_updDateInformasiDimengerti($this->kdMember,""));
            if($check){
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan di penyimpanan sistem");
            }
        }return $this->mbgs->resFalse($portal['msg']);

    }

    function _settingKeyMember($member,$kodePage,$kunci){
        // $kodePage=;
        $q="";
        foreach ($member as $key => $v) {
            $q.=" update appkey set 
                    kunci=".$kunci."
                where kdMember=".$this->mbgs->_valforQuery($v['kdMember'])." and 
                    kdFitur!=".$this->mbgs->_valforQuery($kodePage)." and
                    kdFitur like '%".explode("/",$kodePage)[0]."%';";
        }
        return $q;
    }
    function exampleUpload(){
        // $file=$_POST['file'];
        // $img=$file['img'];
        // $file=$file['file'];

        // $baseEND=json_decode((base64_decode($_POST['data'])));
        // $keterangan =$baseEND->{'keterangan'};
        // $judul      =$baseEND->{'judul'};
        // $kdKate     =$baseEND->{'kdKate'};
        // $sumber     =$baseEND->{'sumberKate'};

        // $namaFile="";
        // foreach ($img as $key => $v) {
        //     $namaFile=$this->_uploadImage($v['src'],"fs_sistem/upload/image/".$v['nama']);
        // }

        // $namaFile1='';
        // foreach ($file as $key => $v) {
        //     // $namaFile.=$this->_uploadImage($v['src'],$v['nama'])."<2G18>";
        //     $namaFile1=$this->_uploadFiles($v['data'],"".$v['nama']);
        // }
    }
    public function _uploadFiles($file,$nama){
        $pdf_decoded = base64_decode($file,true);
        $nama=explode(".",$nama);
        date_default_timezone_set("America/New_York");
        $namaFile=$nama[count($nama)-2]."-".date("Y-m-d-h-i-sa").".".$nama[count($nama)-1];
        $lokasiFile='./assets/fs_sistem/upload/files/'.$namaFile;
        file_put_contents($lokasiFile, $pdf_decoded);
        return substr($lokasiFile,2);
    }

    public function _setNotification($fitur,$info,$nmBtn,$tingkatJabatan){
        $keyTabel="kdNotif";
        $kdTabel=$this->qexec->_func("
            select ".$keyTabel." 
            from notif
            ORDER BY ".$keyTabel." DESC limit 1"
        );
        if(count($kdTabel)>0){
            $kdTabel=$kdTabel[0][$keyTabel]+1;
        }else{
            $kdTabel=1;
        }

        $qNotif=" INSERT INTO notif
                    (kdNotif,fitur, isiNotif, nmTombol, url)
                VALUES 
                    (
                        ".$this->mbgs->_valforQuery($kdTabel).",
                        ".$this->mbgs->_valforQuery($fitur).",
                        ".$this->mbgs->_valforQuery($info).",
                        ".$this->mbgs->_valforQuery($nmBtn).",
                        ".$this->mbgs->_valforQuery($this->mbgs->_getUrl($fitur))."
                    );";
        $qNotif.=" INSERT INTO notifuser(kdMember, kdNotif) (".$this->mbgs->_dmemberSetingkat($tingkatJabatan,$kdTabel).")"; // tingkat 3 bisa dicek di tabel jabatan kolom setingkat

        return $this->qexec->_multiProc($qNotif);
    }
    function refreshHakAkses(){
        $portal=$this->_keamanan($_POST['code'],_getNKA("d-memb",false));
        if($portal['exec']){
            $baseEND=json_decode((base64_decode($_POST['data'])));
        
            $kdJabatan  =$baseEND->{'kdJabatan'};
            $kdMember   =$baseEND->{'kdMember'};
            $a=array();
            $a['kdMember']=$kdMember;
            $a['kdJabatan']=substr($kdJabatan,strlen($kdJabatan)-1);
            // return print_r($a);
            $check=$this->addKeySistemPaksa(base64_encode(json_encode($a)));
            if($check){
                return $this->mbgs->resTrue($this->_);
            }else{
                return $this->mbgs->resFalse("Terjadi Kesalahan di penyimpanan sistem");
            }
        }return $this->mbgs->resFalse($portal['msg']);
    }
    public function _uploadImage($file,$nama){
        $split=explode("/",$nama); 
        $flokasi="fs_sistem/upload/image/";// default foldar jika ber ubah maka tambahakan dinamanya
        if(count($split)>1){
            $flokasi='';
            foreach ($split as $key => $v) {
                if($key==count($split)-1){
                    $nama=$v;
                }else{
                    $flokasi.=$v."/";
                }
            }
            // $flokasi.=$split[0]."/";
            // $nama=$split[count($split)-1];
        }
        $nama=explode(".",$nama);
        switch($nama[count($nama)-1]){
            case "png":$image=substr($file,22);break;
            case "PNG":$image=substr($file,22);break;
            case "pdf":$image=substr($file,22);break;
            default:$image=substr($file,23);break;
        }
        // $image=substr($file,23);
        // return print_r($nama[1]);
        date_default_timezone_set("America/New_York");
        $namaFile=$nama[count($nama)-2]."-".date("Y-m-d-h-i-sa").".".$nama[count($nama)-1];

        
        $delspace=explode(" ",$namaFile);
        $namaFile="";
        foreach ($delspace as $key => $value) {
            $namaFile.=$value;
        }
        $lokasiFile='./assets/'.$flokasi.$namaFile;
        write_file($lokasiFile,base64_decode($image));
        return $namaFile;
    }
    function _checkKeyApp($keyForm,$kdMember){
        $kodeForm=false;
        $kodeForm=$keyForm;
        // return print_r($this->mbgs->_qCekKey($kodeForm,$kdMember));
        $q=$this->mbgs->_qCekKey($kodeForm,$kdMember);
        $member=$this->qexec->_func($q);
        // return count($member);
        if(count($member)==1){
            return true;
        }
        return false;
    }
    function _keamanan($code,$codeForm){
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

        $this->kdMember=$this->sess->kdMemberMember;
        $this->kdMember1=$this->sess->kdMemberMember1;
        $this->nmMember=$this->sess->nmMember;
        $this->kdJabatan=$this->sess->kdMemberJabatan;
        $this->kdKantor=$this->sess->kdMemberKantor;
        $this->nmKantor=$this->sess->nmKantor;
        $kdMember=$this->sess->kdMemberMember;
        if($kdMember==null) {
            return $this->mbgs->resF("can't access !!!");
        }
        
        if(!$this->mbgs->_backCodes(base64_decode($code))){
            return $this->mbgs->resF("Tidak Sesuai Keamanan Sistem !!!");
        }
        if($this->_checkKeyApp($codeForm,$kdMember)==0){
            return $this->mbgs->resF("Anda tidak memiliki ijin !!!");
        }
        return $this->mbgs->resT("");
    }
    function addKeySistem($val){
        // $a=array();
        // $a['kdMember']="2G18-memb-1";
        // $a['kdJabatan']="6";
        // return print_r(base64_encode(json_encode($a)));
        // eyJrZE1lbWJlciI6IjJHMTgtbWVtYi0xIiwia2RKYWJhdGFuIjoiNiJ9

        $baseEND=json_decode((base64_decode($val)));
        // return print_r($baseEND);
        $kdMember=$baseEND->{'kdMember'};
        $kdJabatan=$baseEND->{'kdJabatan'};

        $nmApp=$this->qexec->_func("select * from app where kdApp='".$this->mbgs->app['kd']."'");
        $q="";
        if(count($nmApp)==0){
            $q.=" INSERT INTO app(kdApp,nmApp) VALUES ('".$this->mbgs->app['kd']."','".$this->mbgs->app['nm']."');";
        }


        $fitur=$this->qexec->_func("select * from appfitur where kdApp='".$this->mbgs->app['kd']."'");
        $fiturSystem=_getNKA("",true);
        // return $this->mbgs->_log($q);
        if(count($fitur)!=count($fiturSystem)){
            $q.=" delete from appfitur where kdApp='".$this->mbgs->app['kd']."';";
            $q.=" INSERT INTO appfitur(kdApp, kdFitur, nmFitur) VALUES ";
            foreach ($fiturSystem as $key => $v) {
                $q.="(
                        ".$this->mbgs->_valforQuery($this->mbgs->app['kd']).",
                        ".$this->mbgs->_valforQuery($v['kd']).",
                        ".$this->mbgs->_valforQuery($v['page'])."
                    ),";
            }
        }
        if(strlen($q)>0){
            $q=substr($q,0,strlen($q)-1).";";
        }
        
        $kunci=$this->qexec->_func("select * from appkey where kdMember=".$this->mbgs->_valforQuery($kdMember)."");
        if(count($kunci)!=count($fiturSystem)){
            $q.=" delete from appkey where kdMember=".$this->mbgs->_valforQuery($kdMember).";";
            $q.=" INSERT INTO appkey(kdApp,kdMember, kdFitur, Kunci) VALUES ";
            foreach ($fiturSystem as $key => $v) {
                foreach($v['kdJabatan'] as $key1 => $v1){
                    // print_r($v1."|".$kdJabatan."<br>");
                    if($v1==$kdJabatan){
                        $q.="('".$this->mbgs->app['kd']."',".$this->mbgs->_valforQuery($kdMember).",".$this->mbgs->_valforQuery($v['kd']).",'0'),";
                    }
                }
            }
            $q=substr($q,0,strlen($q)-1);
        }
        if(strlen($q)==0){
            return true;
        }
        // return $this->mbgs->_log($q);
        $check=$this->qexec->_multiProc($q);
        if($check){
            return true;
        }
        return false;
        // print_r("sukses");
    }
    function addKeySistemPaksa($val){
        // $a=array();
        // $a['kdMember']="2G18-memb-1";
        // $a['kdJabatan']="5";
        // return print_r(base64_encode(json_encode($a)));
        // eyJrZE1lbWJlciI6IjJHMTgtbWVtYi0xIiwia2RKYWJhdGFuIjoiNSJ9
        // eyJrZE1lbWJlciI6IjJHMTgtbWVtYi05Iiwia2RKYWJhdGFuIjoiMSJ9

        $baseEND=json_decode((base64_decode($val)));
        // return print_r($baseEND);
        $kdMember=$baseEND->{'kdMember'};
        $kdJabatan=$baseEND->{'kdJabatan'};

        $nmApp=$this->qexec->_func("select * from app where kdApp='".$this->mbgs->app['kd']."'");
        $q="";
        if(count($nmApp)==0){
            $q.=" INSERT INTO app(kdApp,nmApp) VALUES ('".$this->mbgs->app['kd']."','".$this->mbgs->app['nm']."');";
        }


        $fitur=$this->qexec->_func("select * from appfitur where kdApp='".$this->mbgs->app['kd']."'");
        $fiturSystem=_getNKA("",true);
        if(count($fitur)!=count($fiturSystem)){
            $q.=" delete from appfitur where kdApp='".$this->mbgs->app['kd']."';";
            $q.=" INSERT INTO appfitur(kdApp, kdFitur, nmFitur) VALUES ";
            foreach ($fiturSystem as $key => $v) {
                $q.="(
                        ".$this->mbgs->_valforQuery($this->mbgs->app['kd']).",
                        ".$this->mbgs->_valforQuery($v['kd']).",
                        ".$this->mbgs->_valforQuery($v['page'])."
                    ),";
            }
        }
        if(strlen($q)>0){
            $q=substr($q,0,strlen($q)-1).";";
        }
        $kunci=$this->qexec->_func("select * from appkey where kdMember=".$this->mbgs->_valforQuery($kdMember)."");
        $q.=" delete from appkey where kdMember=".$this->mbgs->_valforQuery($kdMember).";";
        $q.=" INSERT INTO appkey(kdApp,kdMember, kdFitur, Kunci) VALUES ";
        foreach ($fiturSystem as $key => $v) {
            foreach($v['kdJabatan'] as $key1 => $v1){
                if($v1==$kdJabatan){
                    $q.="('".$this->mbgs->app['kd']."',".$this->mbgs->_valforQuery($kdMember).",".$this->mbgs->_valforQuery($v['kd']).",'0'),";
                }
            }
        }
        $q=substr($q,0,strlen($q)-1);
        return $this->qexec->_multiProc($q);
    }
}


