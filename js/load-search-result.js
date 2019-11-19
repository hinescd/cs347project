/* eslint-disable no-undef */
$(document).ready(function () {
  const anchors = document.getElementsByClassName('search_anchor')
  const forumIndex = document.getElementById('forum_index')

  /* THIS LOOP ATTACHES EVENT LISTENERS TO THE CLASS LINKS
  IF THOSE LINKS ARE CLICKED IT LOADS THAT FORUM. */
  for (var i = 0; i < anchors.length; i++) {
    // console.log(anchors[i])
    anchors[i].addEventListener('click', function () {
      console.log('Search link clicked!')
      $('#search_index').remove()
      $('#search_results').remove()
      $('#class_index').remove()
      $('#question_page').remove()
      $('#forum_breadcrumb_list').append('<li id="class_index" class="breadcrumb-item"><a href="#0">' + this.parentElement.parentElement.parentElement.className + '</a></li>')
      $('#forum_breadcrumb_list').append('<li id="question_index" class="breadcrumb-item active">' + this.innerHTML + '</li>')

      $.post('../php/class_forum.php', { class: this.parentElement.parentElement.parentElement.id }, function (data) {
        $('#forum_container').append(data)
        document.getElementById('class_forum').style.display = 'none'
      })
      $.post('../php/question-page.php', { question: this.id }, function (data) {
        $('#forum_container').append(data)
      })
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
        document.getElementById('class_forum').style.display = 'block'
      })

    })
  }
})
