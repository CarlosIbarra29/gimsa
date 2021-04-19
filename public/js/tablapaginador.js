$(document).ready(function(){

  $('#TablaPaginador').pageMe({

    pagerSelector:'#paginador',

    activeColor: 'blue',

    prevText:'Anterior',

    nextText:'Siguiente',

    showPrevNext:true,

    hidePageNumbers:false,

    perPage:5

  });

});
