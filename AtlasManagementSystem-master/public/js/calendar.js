$(function () {
  $('.modal_cancel').on('click', function () {
    $('.modal').fadeIn();

    var date = $(this).data('date');
    var number = $(this).data('number');
    var part = $(this).data('part');

    $('#reserveDay').val(date);
    $('#reservePartNumber').text('時間：' + number);
    $('#reservePart').val(part);

    return false;
  });

  $('.modal_close').on('click', function () {
    $('.modal').fadeOut();

    return false;
  })
});
