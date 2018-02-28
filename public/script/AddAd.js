var AdAdd = (function(){

  var deleteSelekt = function(Catalog){
            var SeletUlTrue = false;
            Catalog.child.forEach(function(item, i){
            if((item instanceof SeletUl) || ( (item instanceof inputUl) && (item.type === 'radio') ) ){
                   item.Delete();
                    SeletUlTrue = true;
             }
          });
            if(SeletUlTrue){
             Catalog.child = [];
            }
            return SeletUlTrue;
  }

  var Sumbit = {};
  Sumbit.Parameter = {};
  Sumbit.Fn = function(){
// if(FormAdd.Validacij()){
/*      Cshtora.True();
     Fails(FormAdd.QjObject ,function(){
     FormAdd.submit();
   });*/
//   }
 }

  var FormAdd = new Form({id:"form#add",button:new Button({id:"button_add_annou", Fn:Sumbit})});

  var Name = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#name",oberka:"div#input_name",maxSize:30,surely:true});
  Name.htmlGet();
   var Email = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#email",oberka:"div#input_email",maxSize:35,surely:true});
   Name.htmlGet();

   var Phone = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#phone",oberka:"div#input_phone",surely:true});
   Phone.htmlGet();

   var Title = new inputUl({ObjectForm:FormAdd,teg:"input",id:"#title",oberka:"div#input_title",maxSize:120,surely:true});
   Title.htmlGet();

   var Post = new inputUl({ObjectForm:FormAdd,teg:"textarea",id:"#post",oberka:"div#input_post",maxSize:1500,surely:true});
   Post.htmlGet();

  var RegionAdd = new SeletUl({ObjectForm:FormAdd,id:"#region_select",oberka:"div#region",surely:true});

  // var privatEmail = inputUl.inputUlSet({id:"#privat_email",ObjectForm:FormAdd});
  RegionAdd.HtmlGet();
  RegionAdd.JsonOptionSet("/data/regions", function(){
      //
  });
  RegionAdd.ObjectChange(
          function(){
             var SeletUlTrue = deleteSelekt(RegionAdd);
             var SiteAdd = new SeletUl({ObjectForm:FormAdd,id:"#sity_select", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Город",surely:true});
             SiteAdd.parent = RegionAdd;
             RegionAdd.child.push(SiteAdd);
             SiteAdd.childSeletSQL({
              url:'/data/city',
              ParentValue:true,
              FN:function(){
                SiteAdd.QjObject.parent().attr("style","clear: both;");
                SiteAdd.ObjectChange();

              }
            });
          }
  );
   var CatalogAdd = new SeletUl({ObjectForm:FormAdd,id:"#category_select",oberka:"div#categorij",surely:true});
   CatalogAdd.HtmlGet();
   CatalogAdd.JsonOptionSet("/data/categoreys", function(){
   });

   CatalogAdd.QjObject.parent().attr("style","clear: both;");
   var CatalogAddSeletUlTrue = true;
   CatalogAdd.ObjectChange(
           function(){
            if(!CatalogAddSeletUlTrue) CatalogAddSeletUlTrue = deleteSelekt(CatalogAdd);
             var TipAdd = new SeletUl({ObjectForm:FormAdd,parent:CatalogAdd, id:"#tip_select",oberka:"#tip",oberkaClass:"col-md-6 form-group has-feedback",divContener:"form#searc-form",placeholder:"Тип обьявления"});
             CatalogAdd.child.push(TipAdd);
             TipAdd.childSeletSQL({
               url:"/data/tip",
               ParentValue:true,
               FN:function(){
            TipAdd.QjObject.parent().attr("style","clear: both;");
               }
             });

             var Breeds = new SeletUl({ObjectForm:FormAdd, parent:CatalogAdd, id:"#breeds", name:"breeds", oberka:"#searc_breeds",oberkaClass:"col-md-6 form-group has-feedback",parentDiv:"form#searc-form", placeholder:""});
                  CatalogAdd.child.push(Breeds);
                  Breeds.childSeletSQL({
                    url:"/data/breeds",
                    ParentValue:true,
                    placeholder:true,
                    FN:function(){
                      Breeds.QjObject.parent().attr("style","clear: both;");
                    }});

          CatalogAdd.RequestAddition('/data/categoreys/addition/'+CatalogAdd.value,
            function(Parm){
                    var VozrastBuild = function(polHtml){
                       var Vozrast = new inputUl({ObjectForm:FormAdd,parent:CatalogAdd, id:'vozrast', oberka:'#input_vozrast',name:'vozrast',type:"radio",class:'border', placeholder:"Возраст"});
                       CatalogAdd.child.push(Vozrast);
                       Vozrast.BuildInputsRadio('/data/vozrast',function(){})
                        .then(
                          VozrastHtml => {
                          //  Pol.Delete(); Vozrast.Delete();
                              $(Breeds.oberka).after(Pol.html+Vozrast.html);
                              $(Pol.oberka).attr("style","clear: both;");
                              $(Vozrast.oberka).attr("style","clear: both;");
                          },
                          reject => {console.log(reject);}
                        );
                    };
                if((Parm.pol) || (Parm.vazrast)){
                  var Pol = new inputUl({ObjectForm:FormAdd, parent:CatalogAdd, id:'pol', oberka:'#input_pol', name:'pol', type:"radio",class:'border', placeholder:"Пол"});
                  CatalogAdd.child.push(Pol);
                  Pol.BuildInputsRadio('/data/pol', function(){})
                  .then(
                        polHtml => {return polHtml},
                        reject => {console.log(reject)})
                 .then(VozrastBuild);
                }
            });
           CatalogAddSeletUlTrue = false;
           });
})();
