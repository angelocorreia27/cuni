$('document').ready(function(){
    $('.loader').show();
    getBandas();
	
});


var getBandas = function(){

    var items = [];

    var showData = $('#map-cobricao ul');

    showData.empty();

    $.getJSON('bandas',function(result){
        for (var i = 0; i < result.length; i++) {
            items.push("<li class='list-inline-item bg-info banda-" + result[i].id + "' style='padding-left: 0; padding-right: 0;'><a href='#' class=''>" + result[i].significado + "</a><ul class='todo-list'></ul></li>");              
        }
        showData.append(items);
        var length_list = $('#input-max-macho').val();
        getTatuagem(1,result,length_list,'primary');
        var length_list = $('#input-max-femea').val();
        getTatuagem(0,result,length_list,'danger');
    });
}


var getTatuagem = function(sexo,bandas,length_list,color){
	var items = [];
    var id_banda;
	var showData;
    
    for (var i = 0; i < bandas.length; i++) {
        id_banda = bandas[i].id;
       (function(id_banda){
            $('.loader').show();
            $.getJSON("/getListTatuagem/"+sexo+"/"+id_banda,function(data){
                $.each(data,function(key,value){
                    items.push('<li class="label-'+color+'">'+value.tatuagem+'</li>'); 
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
                $('.loader').hide();                
            });

       }(id_banda));      
    }
}