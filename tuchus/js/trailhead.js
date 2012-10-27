// Customize select boxes
$(function(){ 
  if (!$.browser.opera) {
    $('.input-select-wrap select').not('.cell-select select').each(function(){
      var title = $(this).attr('title');
      title = $('option:selected',this).text();
      $(this)
        .css({'z-index':10,'opacity':0,'appearance':'none', '-khtml-appearance':'none', '-webkit-appearance': 'none'})
        .after('<span class="select">' + title + '</span>')
        .change(function(){
          val = $('option:selected',this).text();
          $(this).next().text(val);
        })
    });
  }; 
});

// Tablesorter
$('.sortable').tablesorter();

// Tooltips
$('.tip').tooltip();

// Datepicker
$('.input-date input').datepicker({format:'yyyy-mm-dd'})
  .on('changeDate', function(ev){
    $(this).datepicker('hide');
});

$('.timepicker').timepicker({
  defaultTime: 'value'
});

// Auto slugger
$('#publish-title').makeSlug({
    slug: $('.auto-slug')
});

$(function() {
  $('.input-tags input').tagsInput({
    width:'auto',
    'defaultText':'add an item...'
  });
});


// In CP flash messages
$('#flash-msg')
  .delay(50)
  .animate({'margin-top' : '0'}, 900, 'easeOutBounce')
  .delay(3000)
  .animate({'margin-top' : '-74px'}, 900, 'easeInOutBack');

// Login error message
$('#login #form-errors')
  .delay(50)
  .animate({'margin-top' : '-245px'}, 500, 'easeOutBack');

// Hide iPhone address bar
window.addEventListener("load",function() {
  setTimeout(function(){
    window.scrollTo(0, 1);
  }, 0);
});


// The Almighty Grid!
$("a.grid-add-row").live("click", function () {
  var $grid      = $(this).parent().find(".grid:first");
  var row        = $grid.find("tbody:first").children(':last');     
  var row_count  = parseInt(row.children("th:first-child").text());
  var replaceKey = false;

  row.clone().find("input, textarea, select").each(function (i) {
    var replaceCount = 0;

    if (false == replaceKey) {
      replaceKey = this.name.match(/\[(\d+)\]/g).length;
    }

    this.name = this.name.replace(/\[(\d+)\]/g, function (e, a) {
      replaceCount++;

      if (replaceCount == replaceKey) {
        return "[" + (parseInt(a, 10) + 1) + "]";       
      } 

      return "["+a+"]";
    });
        
    this.value = $(this).parent("td").data("default");
    this.selected = !1;
  }).end().appendTo($grid).children("th:first-child").html(row_count + 1);

  return !1;
});

$("a.grid-delete-row").live("click", function() {
  $(this).closest('tr').remove();
  return false;
});

var stick_helper_width = function(e, tr) {
  var $originals = tr.children();
  var $helper = tr.clone();
  $helper.children().each(function(index) {
    $(this).width($originals.eq(index).width())
  });
  return $helper;
};

$(".grid tbody").sortable({
  helper: stick_helper_width,
  handle: 'th.drag-indicator',
  placeholder: 'drag-placeholder',
  forcePlaceholderSize: true,
  axis: 'y',

  'start': function (event, ui) {
    var num_cols = $(this).find('tr')[0].cells.length;
    ui.placeholder.html('<td colspan='+num_cols+'>&nbsp;</td>');
  },

  update: function(event, ui) {
    $(event.target).find('> tr').each(function() {

      row_number = $(this).index();

      $(this).children("th:first-child").html(row_number+1)
      $(this).find("input, textarea, select").each(function() {

        var replaceCount = 0;
        var replaceKey = false;

        if (false == replaceKey) {
          replaceKey = this.name.match(/\[(\d+)\]/g).length;
        }

        this.name = this.name.replace(/\[(\d+)\]/g, function (e, a) {
          replaceCount++;

          if (replaceCount == replaceKey) {
            return "[" + row_number + "]";
          } 

          return "["+a+"]";
        });

      });

    })
  }
});

$('.confirm').click(function() {
  $(this).removeClass('confirm');
  $(this).text("Do it.");
  $(this).unbind();
  return false;
});