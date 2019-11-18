/* This javascript will handle the user action of selection a
   specific class forum question and loading that question's specific
   page. */
/* eslint-disable no-undef */
$(document).ready(function () {
  // console.log('load-specific-forum.js loaded')
  const classIndex = document.getElementById('class_forum')
  const anchors = document.getElementsByClassName('question_anchor')
  const forumIndex = document.getElementById('forum_index')
  // console.log(anchors)
  /* THIS LOOP ATTACHES EVENT LISTENERS TO THE CLASS LINKS
  IF THOSE LINKS ARE CLICKED IT LOADS THAT FORUM. */
  for (var i = 0; i < anchors.length; i++) {
    // console.log(anchors[i])
    anchors[i].addEventListener('click', function () {
      classIndex.style.display = 'none'
      $('#class_index').removeClass('active')
      var contents = $('#class_index').text()
      $('#class_index').empty()
      $('#class_index').append('<a href="#0">' + contents + '</a>')
      $('#forum_breadcrumb_list').append('<li id="question_index" class="breadcrumb-item active">' + this.text + '</li>')
      document.querySelector('#bc_index a').addEventListener('click', function () {
        $('#question_page').remove()
        $('#question_index').remove()
        $('#class_forum').remove()
        $('#class_index').remove()
        $('#bc_index a').remove()
        $('#bc_index').html('Index')
        $('#bc_index').addClass('active')
        forumIndex.style.display = 'block'
      })
      document.querySelector('#class_index a').addEventListener('click', function () {
        $('#question_page').remove()
        $('#question_index').remove()
        var content = $('#class_index a').text()
        $('#class_index a').remove()
        $('#class_index').html(content)
        $('#class_index').addClass('active')
        classIndex.style.display = 'block'
      })
      // MAKE REQUEST FOR PARTICULAR FORUM
      $.post('../php/question-page.php', { question: this.parentElement.parentElement.parentElement.id }, function (data) {
        $('#forum_container').append(data)
      })
    })
  }
})
