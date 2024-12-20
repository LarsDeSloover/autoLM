function goto(url){
  window.location.href = url;
}

function ajax_get(url, id){
  $.get( url, function( data ) {
    $("#"+id).html( data );
  });
}

function ajax_post(url, id, postdata){
  $.post( url, postdata, function( data ) {
    $("#"+id).html( data );
  });
}

function read_formdata(id){
  array = $("#"+id).serializeArray(); 
  json = {};
  $.each(array, function () {
    json[this.name] = this.value || "";
  });
  return json;
}
