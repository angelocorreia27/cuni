$('document').ready(function(){
    $('.loader').show();
    $(".popup").hide();
    getBandas();
});


var getBandas = function(){

    var items = [];

    var showData = $('#map-cobricao ul');

    var length_list;

    showData.empty();
    

    if (showData.length){
        $.getJSON('bandas',function(result){
            for (var i = 0; i < result.length; i++) {
                items.push("<li class='list-inline-item bg-info banda-" + result[i].id + "' style='padding-left: 0; padding-right: 0;'><a href='#' class=''>" + result[i].significado + "</a><ul class='todo-list'></ul></li>");              
            }
            showData.append(items);
            $('.loader').show();

            length_list = $('#input-max-macho').val();
            $.ajax({
                url:getTatuagem(1,result,length_list,'primary'),
                success:function(){
                    length_list = $('#input-max-femea').val();
                    $.ajax({
                        url:getTatuagem(0,result,length_list,'danger'),
                        success:function(){
                            $('.loader').hide(); 
                            $.ajax({
                                url:startContext(),
                                success:function(){
                                    showPopup();
                                }
                            });                        
                        }
                    });
                }
            });
        });
    }
}

var getTatuagem = function(sexo,bandas,length_list,color){
	var items = [];
    var id_banda;
    var showData;
    var bandaLenght = 0 ;

    
    for (var i = 0; i < bandas.length; i++) {
        id_banda = bandas[i].id;
        bandaLenght = bandas.length;
        (function(id_banda,sexo){
            
           // $lisTat = '/getListTatuagem/'+sexo+"/"+id_banda;

            $.getJSON('getListTatuagem/'+sexo+"/"+id_banda,function(data){
                $.each(data,function(key,value){
                    if (sexo==0){
                        items.push('<li class="example label-'+color+'">'+value.tatuagem+'</li>'); 
                    }else{
                       items.push('<li class="label-'+color+'">'+value.tatuagem+'</li>'); 
                   }
               });     
                if (data.length < length_list){
                    for (var i = 1; i <= length_list-data.length; i++) {
                     items.push('<li style="height:40px""></li>');
                 }
             }

             var route = '#map-cobricao ul li.banda-'+id_banda+' ul';

             showData = $(route);

             showData.append(items);

             items=[];                                              
         });
        }(id_banda,sexo));     
    }
}

///////////////////////////////////////context menu//////////////////////////
var startContext = function() {
    $('#map-cobricao ul li ul.todo-list li.example').contextmenu({
        target: "#context-menu"
    });
};

var showPopup = function(){
    var href;
    $('#context-menu ul.dropdown-menu li a').on('click',function(){
        href = $(this).attr('href');
        href = href + '?popup=true';
        $.colorbox({iframe:true, width:"80%", height:"80%", href:href});
    });   
}