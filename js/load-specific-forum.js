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
      document.getElementById('forum_container').innerHTML = fetch('../php/class_forum.php', '{method: "POST"}')
    })
  }
})
