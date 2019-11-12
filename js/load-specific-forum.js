/* eslint-disable no-undef */
$(document).ready(function () {
  // console.log('load-specific-forum.js loaded')

  const anchors = document.getElementsByClassName('class_anchor')
  // console.log(anchors)

  for (var i = 0; i < anchors.length; i++) {
    // console.log(anchors[i])
    anchors[i].addEventListener('click', function () {
      console.log('click')
      document.getElementById('forum_index').style.display = 'none'
      $('#bc_index').removeClass('active')
      $('#bc_index').empty()
      $('#bc_index').append('<a href="#0">Index</a>')
      $('#forum_breadcrumb_list').append('<li id="class_index" class="breadcrumb-item active">' + this.text + '</li>')
      $.post('../php/class_forum.php', { class: this.parentElement.parentElement.parentElement.id }, function (data) {
        $('#forum_container').html(data)
      })
    })
  }
})
