$(document).ready(()=>{
   if($("div").is("#AllSelect-admin")){
     let Countrys = new SeletUl({id:"#countrys_select", oberka:"#countrys", ObjectForm:null});
     Countrys.choneSelect();
     let PlaceForm = new Form({active:false});
     let Region = new SeletUl({id:"#region_select", oberka:"#site_select", ObjectForm:PlaceForm});
     Region.HtmlGet();
     Region.choneSelect();

     Region.ObjectChange(()=>{
       let fishSite = $("div#null-site");
       if(fishSite.length !== 0){
    /*   let SelectRegionHtml = '<div id="site_select">\n'+
                              '<select id="sity_select_admin" data-placeholder="Город" style="width: 100%; display: none;" class="chosen-select" tabindex="-1" name="sity_select_admin">\n'+
                              '<option value=""></option>\n'+
                              '</select>\n'+
                              '</div>\n';*/
                        //  '<div class="col-md-12 selekt">\n'+
                        //  '<a class="btn btn-default" href="/fyurer/select/detail/citys">Подробней</a>\n'+
                        //  '</div>'
      fishSite.fadeOut(300, () => {
                          $(this).remove();
                        //  let JQSelectRegionHtml = $(SelectRegionHtml);
                        //  $('div.site_select').html(JQSelectRegionHtml);
                          var Site = new SeletUl({parent:Region, id:"#sity_select", ObjectForm:PlaceForm, name:"id_city", oberka:"div#site",oberkaClass:"col-md-6 form-group has-feedback",surely:true});
                          Site.BuildSelect();
                          Site.childSeletSQL({ParentValue:Region.value, url:'/data/city'});

                       });

     }
     });


  };
});
