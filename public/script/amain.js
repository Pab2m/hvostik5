$(document).ready(()=>{
   if($("div").is("#AllSelect-admin")){
     let Countrys = new SeletUl({id:"#countrys_select", oberka:"#countrys", ObjectForm:null});
     Countrys.choneSelect();
     let PlaceForm = new Form({active:false});
     let Region = new SeletUl({id:"#region_select", oberka:"#site_select", ObjectForm:PlaceForm});
     Region.HtmlGet();
     Region.choneSelect();
  // Site.choneSelect();
   let Site = new SeletUl({parent:Region, id:"#sity_select", ObjectForm:PlaceForm, name:"sity_select", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",surely:true});
     Region.ObjectChange(()=>{
       if (Region.child.length){
      //   document.getElementById(Site.oberka.split('#')[1]).remove();
      //   console.log(document.getElementById(Site.oberka.split('#')[1]));
      $(Site.oberka).children().remove();
      Site.RequestAddition("/data/city/"+Region.value, (Parm)=>{

          console.log(Site.BuildSelect(Parm));

        });
       }
       Region.child.push(Site);
       Site.HtmlGet();
       Site.RequestAddition("/data/city/"+Region.value, (Parm)=>{
       Site.QjObject.html(Site.BuildOption(Parm));
       Site.choneSelect();
           });
     });
     let Categorey = new SeletUl({id:'#category_select', oberka:"#categorij",ObjectForm:null,oberkaClass:"col-md-6 form-group has-feedback",surely:true});

     Categorey.choneSelect();
}
});
