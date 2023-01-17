function setModalShow(v) {
  $('#modalH1').html(v.header);
  $('#modalB1').html(v.body);
  $('#modalF1').html(v.footer);
  $('#modalEx1').modal('show');
}
function offModal() {
  $('#modalEx1').modal('hide');
}
function _login() {
  setModalShow({
    header:`<h4 class="modal-title fs-5">Form Login</h4>`,
    body:`
      <div class="input-group mb-3">
        <span class="input-group-text bg-info" style="width:100px;">username</span>
        <input type="text" class="form-control" id="username" placeholder="username" value="">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text bg-info" style="width:100px;">password</span>
        <input type="password" class="form-control" id="password" placeholder="password" value="">
      </div>
    `,
    footer:`
      <button onclick="offModal()" class="btn btn-dark" >close</button>
      <button onclick="_logined()" class="btn btn-info" >Login</button>
    `
  })
}
function _logined() {
  let param={
    username:$('#username').val(),
    password:$('#password').val()
  }
  if(param.username.length==0){
    return alert('mohon sesuaikan isian username !!!');
  }
  if(param.password.length==0){
    return alert('mohon sesuaikan isian password !!!');
  }
  _post('proses/checkUser',param).then(res=>{
    res=JSON.parse(res);
    if(res.exec){
        alert('sukses !!!');
        setTimeout(() => offModal(), 2000);
        _redirect('control/dashboard/'+btoa(JSON.stringify(param)));
    }else{
        return alert(res.msg);
    }
  });
}
function _dtThema() {
  return [
    {value:'pendidikan',valueName:'Pendidikan & Pelatihan'},
    {value:'pengembangan',valueName:'Pengembangan Masyarakat'},
    {value:'riset',valueName:'Riset & Inovasi'},
  ];
}
function btnSearch() {
  searchData({value:$('#search').val()});
}
function searchData(v) {
  return blog(v.value);
}
function blog(search) {
  let fhtml=``,cstart=0,cend=3,fkon=true;

  _.dt.forEach((v,i) => {
      if(cstart==0 && fkon){
        fhtml+=`<div class="row">`;
        fkon=false;
      }
      if(cstart==cend){
        fhtml+=`</div>`;
        cstart=0;
        fkon=true;
      }

      if(search.length!=0 && search!='' && search!=undefined){ 
        if(String(v.judul).toUpperCase().split(search.toUpperCase()).length>1){
          fhtml+=listData(v);
          cstart++;
        }
      }else{
        fhtml+=listData(v);
        cstart++;
      }
  });
  if(cstart!=0){
    fhtml+=`</div>`;
  }
  return $('#blog').html(fhtml);
}
function listData(v) {
  let ffile=v.files.split("/"),nmFile='';
  nmFile=ffile[0];

  return `
      <div class="col-md-4">
        <div class="card blog-post my-4 my-sm-5 my-md-0">
            <img src="${_assets}fs_sistem/upload/blog/${nmFile}" alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, Creative studio Landing page">
            <div class="card-body">
                <div class="details mb-3">
                    <a href="#"><i class="ti-eye"></i> ${v.view}</a>
                </div>
                <a href="${router}control/bloger/${btoa(JSON.stringify({kdBlog:v.kdBlog,thema:v.thema}))}" target="_blank" class="d-block mt-3" style="color:blue;"><h5 class="card-title"> ${v.judul}</h5></a>
            </div>
        </div>
      </div>`;
}

// lib MFC
function _themaDashboard(triwulan) {
  header_.hmenu=[];
  header_.hmenu.push({
      htmlLi:`<a href="${_router}control/dashboard/null" class="nav-link ${(triwulan==1?'text-primary':'text-dark')} text-center">
          <span class="mdi mdi-book-lock-open-outline  text-danger d-block mdi-36px"></span>
            Data Publik
          </a>`
  });
  header_.hmenu.push({
      htmlLi:`<a href="${_router}control/blog" class="nav-link ${(triwulan==2?'text-primary':'text-dark')} text-center">
              <span class="mdi mdi-web text-warning mdi-flip-h d-block mdi-36px"></span>
              Blog
            </a>`
  });
  header_.hmenu.push({
    htmlLi:`<a href="${_router}control/pesan" class="nav-link ${(triwulan==3?'text-primary':'text-dark')} text-center">
        <span class="mdi mdi-message-bookmark text-primary d-block mdi-36px"></span>
          Pesan
        </a>`
});
  header_.hmenu.push({
      htmlLi:`<a href="${_router}control/akun" class="nav-link ${(triwulan==4?'text-primary':'text-dark')} text-center">
          <span class="mdi mdi-account-box text-info d-block mdi-36px"></span>
            Akun
          </a>`
  });
  
  return header_.ex4({
      clsContainer:"container",
      clsHeader:"collapse shadow show " ,
      clsJudul:"navbar-dark bbOpa6  shadow-sm m-0 p-2",
      idCollapse:"idCollapse1",
      // tukar:"Bagus H",
      htmlJudul:`
        <a href="#" class="navbar-brand d-flex align-items-center">
          <img src='${_assets}fs_css/logo/dea-w1.png' class='me-2'  width="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idCollapse1" aria-controls="idCollapse1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      `,
      htmlKeterangan:style_.rowCol({
          clsRow:"",
          col:[
              {
                  cls:"-3 p-0 align-self-center",
                  html:button_.ex1({
                      clsGroup:"p-2",
                      listBtn :[
                        {
                          text:`<span class="mdi mdi-web text-light mdi-spin"></span>`,
                          cls:" btn-sm btn-dark",
                          attr:""
                        },{
                          text:_nmApp,
                          cls:" btn-sm btn-primary ",
                          attr:""
                        } 
                      ],
                  })
              },{
                  cls:"-7 ",
                  html:header_.nav3({
                      clsUl:" justify-content-center",
                      clsLi:" "
                    })
              },{
                  cls:"-2  align-self-center",
                  html:`<div class="dropdown  ">
                          <a href="#" class="d-flex justify-content-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="${_assets}fs_css/boy.png" alt="" width="32" height="32" class="rounded-circle me-2">
                          <strong>${_nama}</strong>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                          <li><a class="dropdown-item" href="${_router}control/akun">Akun</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="${_router+"control/logout"}">Sign out</a></li>
                          </ul>
                      </div>`
              }
          ]
    })
  });
}
function _modal3() {
  return modal_.ex1({
      cls:"modal-dialog-centered modal-dialog-scrollable",
      clsHeader:" bg-primary text-light",
      clsBody:"",
  })
  +modal_.ex1({
      ind:2,
      cls:"modal-dialog-centered modal-dialog-scrollable",
      clsHeader:" bg-warning",
      clsBody:"",
  })
  +modal_.ex1({
      ind:3,
      cls:"modal-dialog-centered modal-dialog-scrollable",
      clsHeader:" bg-danger text-light",
      clsBody:"",
  });
}