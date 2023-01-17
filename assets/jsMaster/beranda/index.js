function onload(){
  
}
function _sendKomunikasi(v){
    setModalShow({
      header:`<h4 class="modal-title fs-5">Konfirmasi</h4>`,
      body:`<p>ingin melakukan pengiriman pesan ?</p>`,
      footer:`
        <button onclick="offModal()" class="btn btn-dark" >close</button>
        <button onclick="_sendKomunikasied()" class="btn btn-info" >Send Message</button>
      `
    })
}
function _sendKomunikasied(){
  let param={
    email:$('#email').val(),
    pesan:$('#pesan').val()
  }
  if(param.email.length==0 || param.email.split("@").length!=2){
    return alert('mohon sesuaikan isian email !!!');
  }
  if(param.pesan.length==0){
    return alert('mohon sesuaikan isian pesan !!!');
  }
  _post('proses/savePesaPublik',param).then(res=>{
    res=JSON.parse(res);
    if(res.exec){
        alert('sukses !!!');
        setTimeout(() => offModal(), 2000);
        $('#email').val('');
        $('#pesan').val('');
    }else{
        return alert(res.msg);
    }
  });
}