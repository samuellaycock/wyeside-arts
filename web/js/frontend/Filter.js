function filterType(button) {
  var type = button.id;

  if ($('#' + type).hasClass('off')) {
    $('#' + type).removeClass('off');
    if (type !== 'type--3' || type !== 'type--5') {
      $('a.type--' + type).removeClass('hide');
    } else {
      $('a.type--3').removeClass('hide');
      $('a.type--5').removeClass('hide');
    }
  } else {
    $('#' + type).addClass('off');
    if (type !== 'type--3' || type !== 'type--5') {
      $('a.type--' + type).addClass('hide');
    } else {
      $('a.type--3').addClass('hide');
      $('a.type--5').addClass('hide');
    }
  }
}
