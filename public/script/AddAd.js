var AdAdd = (function(){
  jQuery(function($) {
   $.mask.definitions['~']='[+-]';
   $('input#phone').mask('+7(999) 999-99-99');
       });


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
 if(FormAdd.Validacij()){
      Cshtora.True();
   Fails(FormAdd.QjObject ,function(){
     FormAdd.submit();
   });
    FormAdd.submit();
   }
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
  var FnRegionAddHeir = function(){
     RegionAdd.childValueGet();
     var SeletUlTrue = deleteSelekt(RegionAdd);
     var SiteAdd = new SeletUl({ObjectForm:FormAdd,id:"#sity_select", name:"id_city", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",placeholder:"Город",surely:true});
     SiteAdd.parent = RegionAdd;
     if(SiteAdd.parent.valueChildren){
        var FnSiteAddOld = function(){
           SiteAdd.value = SiteAdd.parent.valueChildren[SiteAdd.name];
           SiteAdd.Set();
        };
     } else var FnSiteAddOld = function(){};
     RegionAdd.child.push(SiteAdd);
     SiteAdd.childSeletSQL({
      url:'/data/city',
      ParentValue:true,
      FN:function(){
        SiteAdd.QjObject.parent().attr("style","clear: both;");
        SiteAdd.ObjectChange();
        FnSiteAddOld();
      }
    });
  }
  // var privatEmail = inputUl.inputUlSet({id:"#privat_email",ObjectForm:FormAdd});
  RegionAdd.HtmlGet();
  RegionAdd.JsonOptionSet("/data/regions", function(){
      RegionAdd.Set(FnRegionAddHeir);
  });
  RegionAdd.ObjectChange(FnRegionAddHeir);
   var CatalogAdd = new SeletUl({ObjectForm:FormAdd,id:"#category_select",oberka:"div#categorij",surely:true});
   var FnCatalogAddHeir = function(){
       CatalogAdd.childValueGet();
         if(!CatalogAddSeletUlTrue) CatalogAddSeletUlTrue = deleteSelekt(CatalogAdd);
          var TipAdd = new SeletUl({ObjectForm:FormAdd,parent:CatalogAdd, id:"#tip_select",name:'id_type',oberka:"#tip",oberkaClass:"col-md-6 form-group has-feedback",divContener:"form#searc-form",placeholder:"Тип обьявления"});

          if(TipAdd.parent.valueChildren){
             var FnTipAddOld = function(){
                TipAdd.value = TipAdd.parent.valueChildren[TipAdd.name];
                TipAdd.Set();
             };
          } else var FnTipAddOld = function(){};
          CatalogAdd.child.push(TipAdd);
          TipAdd.childSeletSQL({
            url:"/data/tip",
            ParentValue:true,
            FN:function(){
            TipAdd.QjObject.parent().attr("style","clear: both;");
            FnTipAddOld();

            }
          });

          var Breeds = new SeletUl({ObjectForm:FormAdd, parent:CatalogAdd, id:"#breeds", name:"id_breed", oberka:"#searc_breeds",oberkaClass:"col-md-6 form-group has-feedback",parentDiv:"form#searc-form", placeholder:""});
              if(TipAdd.parent.valueChildren){
                 var FnBreedsOld = function(){
                    Breeds.value = Breeds.parent.valueChildren[Breeds.name];
                    Breeds.Set();
                 };
              } else var FnBreedsOld = function(){};
               CatalogAdd.child.push(Breeds);
               Breeds.childSeletSQL({
                 url:"/data/breeds",
                 ParentValue:true,
                 placeholder:true,
                 FN:function(){
                   Breeds.QjObject.parent().attr("style","clear: both;");
                   FnBreedsOld();
                 }});

       CatalogAdd.RequestAddition('/data/categoreys/addition/'+CatalogAdd.value,
         function(Parm){
                 var VozrastBuild = function(polHtml){
                    var Vozrast = new inputUl({ObjectForm:FormAdd,parent:CatalogAdd, oberka:'#input_vozrast',name:'id_vozrast',type:"radio",class:'border', placeholder:"Возраст"});
                    if(Vozrast.parent.valueChildren){//console.log(Vozrast.parent.valueChildren);
                       var FnVozrastOld = function(){
                          Vozrast.value = Vozrast.parent.valueChildren[Vozrast.name];
                          Vozrast.Set();
                       };
                    } else var FnVozrastOld = function(){};//console.log(Pol.parent.valueChildren);
                    if(Pol.parent.valueChildren){
                      var FnPolOld = function(){
                           Pol.value = Pol.parent.valueChildren[Pol.name];
                           Pol.Set();
                      };
                    } else var FnPolOld = function(){};

                    CatalogAdd.child.push(Vozrast);
                    Vozrast.BuildInputsRadio('/data/vozrast',function(){})
                     .then(
                       VozrastHtml => {
                           $(Breeds.oberka).after(Pol.html+Vozrast.html);
                           Vozrast.htmlGet();
                           Pol.htmlGet();
                           $(Pol.oberka).attr("style","clear: both;");
                           $(Vozrast.oberka).attr("style","clear: both;");
                           FnVozrastOld();
                           FnPolOld();
                       },
                       reject => {console.log(reject);}
                     );
                 };
             if(((Parm.pol) || (Parm.vazrast)) || (CatalogAdd.valueChildren["id_pol"]) || (atalogAdd.valueChildren["id_vozrast"])) {
               var Pol = new inputUl({ObjectForm:FormAdd, parent:CatalogAdd, oberka:'#input_pol', name:'id_pol', type:"radio",class:'border', placeholder:"Пол"});
               CatalogAdd.child.push(Pol);
               Pol.BuildInputsRadio('/data/pol', function(){})
               .then(
                     polHtml => {return polHtml},
                     reject => {console.log(reject)})
              .then(VozrastBuild);
             }
         });
        CatalogAddSeletUlTrue = false;
        }
    CatalogAdd.HtmlGet();
    CatalogAdd.JsonOptionSet("/data/categoreys", function(){
      CatalogAdd.Set(FnCatalogAddHeir);
    }
   );

   CatalogAdd.QjObject.parent().attr("style","clear: both;");
   var CatalogAddSeletUlTrue = true;
   CatalogAdd.ObjectChange(FnCatalogAddHeir);
})();
