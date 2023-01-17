function _onload(data){
    $('#footer').html(startmfc.endBootstrapHTML(2,undefined,"tabel"));
  _.pesan=data.pesan;
  const main=document.querySelector("main");
  main.innerHTML=_themaDashboard(3);
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
                        html:`<span class="mdi mdi-folder-arrow-left mdi-24px"></span> <b>Daftar Pesan</b>`,
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
function respon(){
    $('#viewData').html(setTabel());
    _btabelStart("dt");
} 
function setTabel(){
    // btnAction=[];
    // btnAction.push({ 
    //     clsBtn:`btn-outline-warning fzMfc`
    //     ,func:"updData()"
    //     ,icon:`<i class="mdi mdi-grease-pencil"></i>`
    //     ,title:"Perbarui"
    // });
    return btabel(
        {
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.pesan,
                    no:1,
                    kolom:["email","pesan"],
                    namaKolom:["Pengirim","Pesan"],
                    // action:btnAction
                })
        });
} 
