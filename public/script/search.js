var search = (function(){
yepnope("/script/jquery.history.js");

var Sumbit = function(){  //
  var DataGet = UrlGetSearch();
  if(DataGet.length !== 0){
    var Ht = Cshtora.True();
    delete DataGet.length;
    var success = function(data){
        Ht.False();
        var content = $("#content-left");
            content.hide(300);
            content.html(data);
            content.show(300);
       }

 var  error = function(){
     console.log("Error search AJAX!!!");
     Ht.False();
 }
      $.ajax({
        url: "/search/data/ajax/",
        data: DataGet,
        success: success,
        error: error,
        dataType: "html"
      });
  }
}

  var deleteSelekt = function(Catalog){
            var SeletUlTrue = false;
            Catalog.child.forEach(function(item, i){
            if(item instanceof SeletUl){
                    item.Delete();
                    SeletUlTrue = true;
            }});
            if(SeletUlTrue){
               Catalog.child = [];
            }
            return SeletUlTrue;
  }

var SearchForm = new Form({id:"form#formSearch",button: new Button({id:"button-search", Fn:Sumbit})});
var TextSerch = inputUl.inputUlSet({id:"#text", name:"post" ,metka:["TextSerch"], teg:"input",maxSize:100,ObjectForm:SearchForm,surely:true});
  //Переделать под jquery deferred www.youtube.com/ watch?v= i8QQSJaBQdY
var Region = new SeletUl({ObjectForm:SearchForm,id:"#region_select_search", name:"region_select" ,metka:["Region"] ,oberka:"div#searc_region",oberkaClass:"col-md-3",divContener:"form#searc-form"}),Site,Catalog;
Region.HtmlGet();
Region.JsonOptionSet("/data/regions", function(){
    //При поиски.
});
Region.ObjectChange(
        function(){
           var SeletUlTrue = deleteSelekt(Region);
           var Site = new SeletUl({ObjectForm:SearchForm,id:"#site_select_search", name:"sity_select", metka:["Site"], oberka:"div#searc_site",oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Город"});
           Site.parent = Region;
           Region.child.push(Site);
           Site.childSeletSQL({
            url:'/data/city',
            ParentValue:true,
            FN:function(){Site.ObjectChange()}
          });
        }
);
var Catalog = new SeletUl({ObjectForm:SearchForm,id:"#category_select_search", name:"category_select", metka:["Catalog"], oberka:"#searc_category",oberkaClass:"col-md-3",divContener:"form#searc-form"});
Catalog.JsonOptionSet("/data/categoreys", function(){
    //При поиски.
});
Catalog.ObjectChange(
  function(){
    var Tip = new SeletUl({ObjectForm:SearchForm,parent:Catalog, id:"#tip",oberka:"#searc_tip",oberkaClass:"col-md-3",divContener:"form#searc-form",placeholder:"Тип обьявления"});
    Tip.childSeletSQL({
      url:"/data/tip",
      ParentValue:true,
      FN:function(){

      }
    });

     var SeletUlTrue = deleteSelekt(Catalog);
     var Breeds = new SeletUl({ObjectForm:SearchForm, parent:Catalog, id:"#breeds", name:"breeds", metka:["Poroda"], oberka:"#searc_breeds",oberkaClass:"col-md-3",parentDiv:"form#searc-form", placeholder:""});
          Breeds.childSeletSQL({
            url:"/data/breeds",
            ParentValue:true,
            placeholder:true,
            FN:function(){

            }});
  }
);

})();
