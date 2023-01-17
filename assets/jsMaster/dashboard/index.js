function _onload(data){
    $('#footer').html(startmfc.endBootstrapHTML(2,undefined,"tabel"));
  _.publik=data.publik;
  const main=document.querySelector("main");
  main.innerHTML=_themaDashboard(1);
  main.innerHTML+=style_.rowCol({
      clsRow:" container-fluid mt-1 justify-content-center",
      col:[{
              cls:"-10",
              html:form()
          }
      ]
  });
  const footer=document.querySelector("footer");
  footer.innerHTML=`<br>
      <div class="container-fluid bg-info text-light p-1 text-center">
          <p>DeaGuru Institute©2023</p>
      </div>
  `+_modal3();
  respon();
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
                        html:`<span class="mdi mdi-folder-arrow-left mdi-24px"></span> <b>Data Publik</b>`,
                    },{
                        cls:"-6 text-end",
                        html:''
                    }
                    
                ]
            }),
        clsBody:"container",
        htmlBody:`
            <div id='viewData' style="margin: auto;" class="mxhight650 overflow-auto p-2">
            </div>` 
        })
}
function respon(v){
    if(v!=undefined){
        _.publik[v.index].nama=v.judul;
        _.publik[v.index].isi=v.isi;
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
} 
function setTabel(){
    btnAction=[];
    btnAction.push({ 
        clsBtn:`btn-outline-warning fzMfc`
        ,func:"updData()"
        ,icon:`<i class="mdi mdi-grease-pencil"></i>`
        ,title:"Perbarui"
    });
    return btabel(
        {
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.publik,
                    no:1,
                    kolom:["nama","isi"],
                    namaKolom:["Judul","value"],
                    action:btnAction
                })
        });
}
function updData(ind){
    modal_.setMo({
        ex:2,
        header:`<h1 class="modal-title fs-5">Perbarui Data</h1>`,
        body:input_.ex4({
            clsDiv:"input-group mb-3",
            clsInput:" bg-warning mwidth150",
            text:"Judul",
            id:"judul",
            tipe:"text",
            cls:"form-control",
            attr:`placeholder="" value='${delUndife(_.publik[ind].nama)}'`,
        })
        +input_.inputGroup({
            clsDiv:"input-group mb-3",
            clsInput:" bg-warning mwidth150", 
            text:"Value",
            html:`
                <textarea class="form-control" id="isi" rows="4" placeholder="">${delUndife(_.publik[ind].isi)}</textarea>
            `
        }),
        footer:modal_.btnClose("btn-secondary")+
            button_.ex2({
                text:`Perbarui`,
                cls:" btn btn-warning",
                attr:`onclick='updDataed(${ind})'`
            })
    });
    _modalShow("2");
}
function updDataed(ind) {
    let param={
        judul:$('#judul').val(),
        isi:$('#isi').val(),
        ind:_.publik[ind].ind,
        index:ind
      }
      if(param.judul.length==0){
        return _toast({bg:'e', msg:"'mohon sesuaikan isian judul !!!'"});
      }
      if(param.isi.length==0){
        return _toast({bg:'e', msg:"'mohon sesuaikan isian value !!!'"}); 
      }
      _post('proses/updDataPublik',param).then(res=>{
        res=JSON.parse(res);
        if(res.exec){
            _toast({bg:'s', msg:"sukses"}); 
            respon(param);
            _modalHide('2');
        }else{
            return alert(res.msg);
        }
      });
}
