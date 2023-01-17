function _onload(data){
    $('#footer').html(startmfc.endBootstrapHTML(2,undefined,"tabel")); 
  const main=document.querySelector("main");
  main.innerHTML=_themaDashboard(4);
  main.innerHTML+=style_.rowCol({
      clsRow:" container-fluid mt-1 justify-content-center",
      col:[{
              cls:"-10",
              html:form()
          }
      ]
  });
  const footer=document.querySelector("footer");
  footer.innerHTML=`
        <br>
        <div class="container-fluid bg-info text-light p-1 text-center">
          <p>DeaGuru Institute©2023</p>
        </div>
  `+_modal3(); 
  // $('#sfooter').html(chart_.js(_assets+"Library/mfc/","Bagus H"));
} 
function form() {
    return card_.ex2({
        clsCard: "mt-2",
        clsHeader:"bgG2 ",
        htmlHeader:style_.rowCol({
                clsRow:"p-1",
                col:[
                    {
                        cls:"-6",
                        html:`<span class="mdi mdi-folder-arrow-left mdi-24px"></span> <b>Data user</b>`,
                    },{
                        cls:"-6 text-end",
                        html:''
                    }
                    
                ]
            }),
        clsBody:"container",
        htmlBody:style_.rowCol({
                    clsRow:" container p-2",
                    col:[
                        {
                            cls:"-6",
                            html:'Username'
                        },{
                            cls:"-6 ",
                            html:input_.ex4({
                                    clsDiv:"input-group",
                                    clsInput:"bg-warning",
                                    text:`<span class="mdi mdi-account-box text-light"></span>`,
                                    id:"nmMember",
                                    tipe:"text",
                                    cls:"form-control",
                                    attr:`placeholder="***" value='${_nama}'`,
                                }) 
                        }
                    ]
                })
                +style_.rowCol({
                    clsRow:" container p-2",
                    col:[
                        {
                            cls:"-6",
                            html:'Password Baru'
                        },{
                            cls:"-6 ",
                            html:input_.ex4({
                                    clsDiv:"input-group",
                                    clsInput:"bg-warning",
                                    text:`<span class="mdi mdi-account-key text-light"></span>`,
                                    id:"passwordNew",
                                    tipe:"password",
                                    cls:"form-control",
                                    attr:`placeholder="***" value=''`,
                                }) 
                        }
                    ]
                })
                +style_.rowCol({
                    clsRow:" container p-2",
                    col:[
                        {
                            cls:"-6",
                            html:'Password Lama'
                        },{
                            cls:"-6 ",
                            html:input_.ex4({
                                    clsDiv:"input-group",
                                    clsInput:"bg-warning",
                                    text:`<span class="mdi mdi-account-key-outline text-light"></span>`,
                                    id:"password",
                                    tipe:"password",
                                    cls:"form-control",
                                    attr:`placeholder="***" value=''`,
                                }) 
                        }
                    ]
                }) 
                +style_.rowCol({
                    clsRow:" container p-2",
                    col:[
                        {
                            cls:"-6",
                            html:''
                        },{
                            cls:"-6 ",
                            html:button_.ex1({
                                    clsGroup:"",
                                    listBtn :[
                                    {
                                        text:`<span class="mdi mdi-file-chart-check text-light"></span>`,
                                        cls:" btn btn-success",
                                        attr:""
                                    },{
                                        text:"Perbarui Data",
                                        cls:" btn btn-warning ",
                                        attr:` onclick="_fupdMember()"`
                                    }
                                    ],
                                })
                        }
                    ]
                }) 
        })
} 
function _fupdMember() {
    modal_.setMo({
        ex:2,
        header:`<h1 class="modal-title fs-5" id="staticBackdropLiveLabel">${"Konfirmasi".toUpperCase()}</h1>`,
        body:"simpan perubahan data ?",
        footer:modal_.btnClose("btn-secondary")
            +button_.ex2({
                text:`perbarui`,
                cls:" btn-sm btn-warning",
                attr:`onclick="_fupdMembered()"`
              })
    });    
    _modalShow("2");
}
function _fupdMembered(){
    param={
        nmMember:$('#nmMember').val(),
        password:$('#password').val(),
        passwordNew:$('#passwordNew').val()
    }
    
    if(((param.nmMember).toUpperCase()==_nama.toUpperCase()) && param.passwordNew.length==0){
        return _toast({bg:'e',msg:'username tidak mengalami perubahan !!!'});
    }
    _post('proses/updMember',param).then(res=>{
        res=JSON.parse(res);
        if(res.exec){
            _modalHide('modalEx1');
            return _redirect("control/logout");
        }else{
            return _toast({bg:'e', msg:res.msg});
        }
    });
}