<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo ($this->_['nm']) ?></title>
    <link href='<?php echo(base_url()."assets/fs_css/logo/".$this->_['logo']) ?>' rel='icon'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <!-- file js bergantung dengan indux sistem  -->
    <link rel='stylesheet' type='text/css'  href='<?php echo base_url();?>assets/library/mfc/library/import.css'>
    <div id="fileMfc"></div>
    <div id='head'></div>
    <script src='<?php echo base_url();?>assets/Library/mfc/library/jquery.js'></script>
    <script src='<?php echo base_url();?>assets/Library/mfc/library/LibMfc.js'></script>
    <script>
      const startmfc=new LibMFC('<?php echo base_url();?>');
      startmfc.startMfc();
      document.write(startmfc.declarationMfc);
    </script>
</head>
<body>
  <main>
  </main>
  <footer></footer>
  <div id="footer"></div>
  <div id="sfooter"></div>

  <script>
        const _router   =<?php echo json_encode(base_url())?>,
            _nmApp  ='<?php echo ($this->_['nm']) ?>',
            _page    =<?php echo json_encode($page)?>,
            _param   =<?php echo json_encode($param) ?>,
            _myCode  =<?php echo json_encode($code) ?>,
            _assets  =<?php echo json_encode($assets)?>,
            _qlogin  =<?php echo json_encode($qlogin)?>;
        let _nama='',
            _kdJabatan='';  
        if(_qlogin){
            _nama    ='<?php echo $this->sess->nmMember;?>',
                _kdJabatan ='<?php echo $this->sess->kdJabatan?>'; 
        }
        
        var _pages=_page+"/"+_page;
        if(_param!=null){
            _pages=_page+"/"+_page+"/"+_param;
        }
        function _sendRequest(url,data){
            return new Promise(function(res){
                $.ajax({
                    type:'post',
                    url:_router+url,
                    data:{
                            data:data
                        },
                    success:function(respon)
                    {
                        res(respon);
                    }
                })
            })
        }
        _sendRequest("WsKomponen/"+_pages,{code:btoa(_myCode)}).then(res=>{
            
            $(document).ready(function() {
                setTimeout(function() {
                    res=JSON.parse(res);
                    $('#head').html(res.head);
                    $('#loading').html('');
                    _onload(res);
                }, 1000);
            });
        })
    </script>

</body>
</html>




