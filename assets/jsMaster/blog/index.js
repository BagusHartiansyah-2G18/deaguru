function _onload(data){
    $('#footer').html(teditor_.lib(_assets+'library/mfc/library/',true)+startmfc.endBootstrapHTML(2,undefined,"tabel")); 

    _.thema=_dtThema();
    _.ind=0;
    _.ind1=0;
    _.thema[_.ind].dt=data.pendidikan;

    
  const main=document.querySelector("main");
  main.innerHTML=_themaDashboard(2);
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
  respon();
  $('#sfooter').html(teditor_.lib(_assets+'library/mfc/library/',false));
//   $('#sfooter').html(chart_.js(_assets+"Library/mfc/","Bagus H"));

    jQuery(document).ready(function() {
        wizardEl = KTUtil.get('kt_wizard_v3');
        formEl = $('#kt_form');
        tinymce.init({
            mode : "textareas",
            //menubar : false,
            forced_root_block : false,
            force_br_newlines : true,
            force_p_newlines : false,
            height: 500,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking save table directionality",
                "emoticons template paste  textpattern responsivefilemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",

            external_filemanager_path: base_url + "/assets/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : base_url + "/filemanager/plugin.min.js"},
            image_advtab: true,        
        });
    })

    var site_url = 'http://localhost:8080/';
    var base_url = 'http://localhost:8080/';

    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
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
                        html:`<span class="mdi mdi-folder-arrow-left mdi-24px"></span> <b>Data Blog</b>`,
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
                            html:'Thema'
                        },{
                            cls:"-6 ",
                            html:input_.inputGroup({
                                    clsDiv:"input-group",
                                    clsInput:"bg-warning",
                                    text:`<span class="mdi mdi-file-tree-outline text-light"></span>`,
                                    // tukar:v.tukar,
                                    html:input_.select({
                                        cls:"form-select",
                                        id:"thema",
                                        attr:` style="padding-inline-start: 30px;" onchange="changeThema(this)"`,
                                        list:_.thema,
                                      })
                                  })
                                
                        }
                    ]
                })
                +input_.lines()
                +tab_.ex2({
                    id:"tab",
                    clsTab:" width50 text-center",
                    tab:[
                      {
                        text:'Data',
                        cls:'',
                        active:"active",
                        html:`
                        <div id='viewData' style="margin: auto;" class="mxhight650 overflow-auto p-2">
                        </div>`,
                      },{
                        text:'Form Entri',
                        cls:'',
                        active:'',
                        html:formEntri(), 
                      }
                    ]
                })
        })
}
function setTabel(){
    btnAction=[];
    btnAction.push({ 
        clsBtn:`btn-outline-info`
        ,func:"preview()"
        ,icon:`<i class="mdi mdi-eye-check"></i>`
        ,title:"Preview"
    });
    btnAction.push({ 
        clsBtn:`btn-outline-warning `
        ,func:"updData()"
        ,icon:`<i class="mdi mdi-grease-pencil"></i>`
        ,title:"Perbarui"
    });
    btnAction.push({ 
        clsBtn:`btn-outline-danger`
        ,func:"delData()"
        ,icon:`<i class="mdi mdi-delete-forever"></i>`
        ,title:"Hapus"
    });
    return btabel(
        {
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.thema[_.ind].dt,
                    no:1,
                    kolom:["judul","tglU"],
                    namaKolom:["Judul","Tgl Upload"],
                    action:btnAction
                })
        });
}
function formEntri() {
    return `
        <div id="btnUpd" style="display:none;">
            `+style_.rowCol({
                clsRow:" container p-2",
                col:[
                    {
                        cls:"-6",
                        html:button_.ex2({
                            text:`batalkan`,
                            cls:" btn-sm btn-secondary float-end",
                            attr:`onclick="btlData()"`
                        })
                    },{
                        cls:"-6 ",
                        html:button_.ex2({
                            text:`perbarui data`,
                            cls:" btn-sm btn-warning widthFull",
                            attr:`onclick="updDatax()"`
                        })
                    }
                ]
            })
    +`</div>`
    +` <div id="btnAdd">
        `+style_.rowCol({
            clsRow:" container p-2",
            col:[
                {
                    cls:"-6",
                    html:''
                },{
                    cls:"-6 ",
                    html:button_.ex2({
                        text:`tambahkan data`,
                        cls:" btn-m btn-primary widthFull",
                        attr:`onclick="addData()"`
                      })
                }
            ]
        })
    +`</div>`
    +style_.rowCol({
        clsRow:" container p-2",
        col:[
            {
                cls:"-6",
                html:'Judul'
            },{
                cls:"-6 ",
                html:input_.ex4({
                        clsDiv:"input-group",
                        clsInput:"bg-warning",
                        text:`<span class="mdi mdi-flower-outline text-light"></span>`,
                        id:"judul",
                        tipe:"text",
                        cls:"form-control",
                        attr:`placeholder="" value=''`,
                    }) 
            }
        ]
    })
    +` <div id="ffile">
        `+style_.rowCol({
            clsRow:" container p-2",
            col:[
                {
                    cls:"-6",
                    html:'File (IMAGE)'
                },{
                    cls:"-6 ",
                    html:input_.ex1({
                        id:"text",
                        tipe:"file",
                        cls:"form-control",
                        attr:`placeholder="ex1" onchange="_readImage(this)"`
                      })
                }
            ]
        })
    +`</div>`
    +input_.simage()
    +teditor_.ex1({
        cls:'',
        id:'isi',
        value:'keterangan',
        clsArea:''
    });
}
function addData() {
    modal_.setMo({
        ex:1,
        header:`<h1 class="modal-title fs-5" id="staticBackdropLiveLabel">${"Konfirmasi".toUpperCase()}</h1>`,
        body:"simpan penambahan data ?",
        footer:modal_.btnClose("btn-secondary")
            +button_.ex2({
                text:`Simpan`,
                cls:" btn-sm btn-primary",
                attr:`onclick="addDataed()"`
              })
    });    
    _modalShow("1");
}
function addDataed(){
    param={
        isi  :tinymce.get('isi').getContent(),
        judul       :$('#judul').val(),
        thema       :$('#thema').val(),
        kdBlog      :(_.thema[_.ind].dt.length==0?1:_.thema[_.ind].dt.length+1)
    }
    if(_isNull(param.judul))return _toast({bg:'e',msg:'Tambahkan Judul Blog !!!'}); 
    if(_vimg.data.length==0)return _toast({bg:'e',msg:'Tambahkan File (IMAGE), minimal 1 !!!'}); 
    if(_isNull(param.isi) || param.isi.length<=13)return _toast({bg:'e',msg:'Tambahkan isi blog !!!'});
    
    _postFile('proses/insBlog',param,_vimg.data).then(res=>{
        res=JSON.parse(res);
        if(res.exec){
            _modalHide('1');
            _vimg.data=[];
            respon(res.data);
        }else{
            return _toast({bg:'e', msg:res.msg});
        }
    });
}

function btlData() {
    $('#tab-1-btn').removeClass("show active");
    $('#tab-1-tab').removeClass("show active");

    $('#tab-0-btn').addClass("show active");
    $('#tab-0-tab').addClass("show active");

    $('#btnAdd').css({display:''});
    $('#btnUpd').css({display:'none'}); 
    $('#ffile').css({display:''});

    $('#tab-1-btn').html("<b>Form Entri</b>"); 
    $('#judul').val('');
    tinymce.get('isi').setContent('keterangan');
    $('#sImage').html('');
    _vimg.data=[];
}
function respon(data){
    if(data!=null){
        _.thema[_.ind].dt=data.dt;
        btlData();
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
} 


function updData(ind) {
    _.ind1=ind;
    tinymce.get('isi').setContent(_.thema[_.ind].dt[ind].isi);
    // get('isi').getContent()

    $('#btnAdd').css({display:'none'});
    $('#btnUpd').css({display:''}); 
    
    $('#ffile').css({display:'none'});

    $('#tab-0-btn').removeClass("show active");
    $('#tab-0-tab').removeClass("show active");

    $('#tab-1-btn').addClass("show active");
    $('#tab-1-tab').addClass("show active");

    $('#tab-1-btn').html("<b>Form Perubahan</b>");

    $('#judul').val(_.thema[_.ind].dt[ind].judul); 
}
function updDatax() {
    modal_.setMo({
        ex:2,
        header:`<h1 class="modal-title fs-5" id="staticBackdropLiveLabel">${"Konfirmasi".toUpperCase()}</h1>`,
        body:"simpan perubahan data ?",
        footer:modal_.btnClose("btn-secondary")
            +button_.ex2({
                text:`Simpan`,
                cls:" btn-sm btn-warning",
                attr:`onclick="updDataed()"`
              })
    });    
    _modalShow("2");
}
function updDataed(){
    param={
        isi         :tinymce.get('isi').getContent(),
        judul       :$('#judul').val(),
        thema       :$('#thema').val(),
        kdBlog      :_.thema[_.ind].dt[_.ind1].kdBlog
    }
    if(_isNull(param.judul))return _toast({bg:'e',msg:'Tambahkan Judul Blog !!!'}); 
    if(_isNull(param.isi) || param.isi.length<=13)return _toast({bg:'e',msg:'Tambahkan isi blog !!!'});
    _post('proses/updBlog',param).then(res=>{
        res=JSON.parse(res);
        if(res.exec){
            _modalHide('2');
            respon(res.data);
        }else{
            return _toast({bg:'e', msg:res.msg});
        }
    });
}
 
function delData(ind) {
    modal_.setMo({
        ex:3,
        header:`<h1 class="modal-title fs-5" id="staticBackdropLiveLabel">${"Konfirmasi".toUpperCase()}</h1>`,
        body:"Hapus Data Ini ?",
        footer:modal_.btnClose("btn-secondary")
            +button_.ex2({
                text:`Hapus`,
                cls:" btn-sm btn-danger",
                attr:`onclick="delDataed(${ind})"`
              })
    });    
    _modalShow("3");
}
function delDataed(ind){
    param={
        thema       :$('#thema').val(), 
        kdBlog      :_.thema[_.ind].dt[ind].kdBlog
    }
    _post('proses/delBlog',param).then(res=>{
        res=JSON.parse(res);
        if(res.exec){
            _modalHide('3');
            respon(res.data);
        }else{
            return _toast({bg:'e', msg:res.msg});
        }
    });
}

function changeThema(v) {
    _.ind=_searchIndCB(_.thema,v.value);
    if(_.thema[_.ind].dt==undefined){
        _post('proses/changeThema',{thema:v.value}).then(res=>{
            res=JSON.parse(res);
            if(res.exec){
                respon(res.data);
            }else{
                return _toast({bg:'e', msg:res.msg});
            }
        });
    }else{
        return respon(null);
    }
}
function preview(ind){
    return _redirectOpen("control/bloger/"+btoa(JSON.stringify({kdBlog:_.thema[_.ind].dt[ind].kdBlog,thema:_.thema[_.ind].dt[ind].thema})));
}