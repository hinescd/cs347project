/* This javascript responds to the user action of selecting a specific class forum.
   Upon making a selection it will hide the forum index, update the breadcrumb,
   then load the questions related to the selected forum. */
/* eslint-disable no-undef */
$(document).ready(function () {
  const forumIndex = document.getElementById('forum_index')
  const anchors = document.getElementsByClassName('class_anchor')

  /* THIS LOOP ATTACHES EVENT LISTENERS TO THE QUESTION LINKS
  IF THOSE LINKS ARE CLICKED IT LOADS THAT FORUM. */
  for (var i = 0; i < anchors.length; i++) {
    // console.log(anchors[i])
    anchors[i].addEventListener('click', function () {
      forumIndex.style.display = 'none'
      $('#bc_index').removeClass('active')
      $('#bc_index').empty()
      $('#bc_index').append('<a href="#0">Index</a>')
      $('#forum_breadcrumb_list').append('<li id="class_index" class="breadcrumb-item active">' + this.text + '</li>')
      document.querySelector('#bc_index a').addEventListener('click', function () {
        $('#class_forum').remove()
        $('#class_index').remove()
        $('#bc_index a').remove()
        $('#bc_index').html('Index')
        $('#bc_index').addClass('active')
        forumIndex.style.display = 'block'
      })
      // MAKE REQUEST FOR PARTICULAR FORUM
      $.post('../php/class_forum.php', { class: this.parentElement.parentElement.parentElement.id }, function (data) {
        $('#forum_container').append(data)
      })
    })
  }
})
