
$(document).ready(function () {

  $('#catalog').modal({
    keyboard: true,
    backdrop: 'static'
  })


  select_item = function (item){
    objCat = $(item).attr('objCat');
    if(objCat!=''){
      $('#filters_'+objCat)[0].value=$(item).html();
    }
  };


  catalog = function(obj, index, report, module) {

    $('#catalog').modal();

    post_data = {
        'ajax[module]': module,
        'ajax[report]': report,
        'ajax[index]':  index,
        'ajax[obj]':    obj,
        'ajax[page]':   '1'
        };

    $('#filters-ajax').load('/index.php/reports/ajax/filter', post_data);
    $('#grid-ajax').load('/index.php/reports/ajax/grid', post_data);

  };

  //  $('#close-catalog').click(function (){
  //    $('#catalog').modal({ show: false});
  //  });

  previous = function (obj, index, report, module){

    page = parseInt($('#actual-page')[0].value);
    if(page>0) page--;
    else page=1;

    post_data = {
        'ajax[module]': module,
        'ajax[report]': report,
        'ajax[index]':  index,
        'ajax[obj]':    obj,
        'ajax[page]':   page
        };

    $('#grid-ajax').load('/index.php/reports/ajax/grid', post_data);
  };

  next = function (obj, index, report, module){

    page = parseInt($('#actual-page')[0].value);
    page++;

    post_data = {
        'ajax[module]': module,
        'ajax[report]': report,
        'ajax[index]':  index,
        'ajax[obj]':    obj,
        'ajax[page]':   page
        };

    $('#grid-ajax').load('/index.php/reports/ajax/grid', post_data);
  };



  /* Update datepicker plugin so that MM/DD/YYYY format is used. */
  $.extend($.fn.datepicker.defaults, {
    parse: function (string) {
      var matches;
      if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
        return new Date(matches[3], matches[1] - 1, matches[2]);
      } else {
        return null;
      }
    },
    format: function (date) {
      var
      month = (date.getMonth() + 1).toString(),
      dom = date.getDate().toString();
      if (month.length === 1) {
        month = "0" + month;
      }
      if (dom.length === 1) {
        dom = "0" + dom;
      }
      return month + "/" + dom + "/" + date.getFullYear();
    }
  });


  $('#btn-reset').click(function (){
    location.reload();
  });
  
});

