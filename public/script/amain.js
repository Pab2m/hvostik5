$(document).ready(()=>{
   if($("div").is("#AllSelect-admin")){
     let Countrys = new SeletUl({id:"#countrys_select", oberka:"#countrys", ObjectForm:null});
     Countrys.choneSelect();
     let PlaceForm = new Form({active:false});
     let Region = new SeletUl({id:"#region_select", oberka:"#site_select", ObjectForm:PlaceForm});
     Region.HtmlGet();
     Region.choneSelect();
     var Site = new SeletUl({parent:Region, id:"#sity_select", ObjectForm:PlaceForm, name:"sity_select", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",surely:true});
     Site.HtmlGet();
  // Site.choneSelect();
     Region.ObjectChange(()=>{
           Site.RequestAddition("/data/city/"+Region.value, (Parm)=>{
            Site.QjObject.html(Site.BuildOption(Parm));
            Site.choneSelect();
            console.log(Site.QjObject);
           });
     });
}
});
