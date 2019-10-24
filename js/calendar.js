/**
 * Javascript file written by Geoffrey Wright and used to display
 * a baseline calander. This will be free for modification and perhaps
 * eventual removal later.
 */

window.onload = function () {
  /* Preamble variables */
  var date = new Date() // today's date
  var monthName = ['January', 'February', 'March', 'April', 'May',
    'June', 'July', 'August', 'September', 'October', 'November', 'December']
  var month = date.getMonth() /* 0-11 */
  var year = date.getFullYear() // year
  var firstDate = monthName[month] + ' ' + 1 + ' ' + year
  var temp = new Date(firstDate).toDateString()
  var firstDay = temp.substring(0, 3) // current month three-char identifier
  var dayName = ['Sun', 'Mon', 'Tue', 'Thu', 'Fri', 'Sat']
  var dayNum = dayName.indexOf(firstDay) // where the first day is starting
  var days = new Date(year, month + 1, 0).getDate() // how many days are in the month

  /* Calendar construction */
  var calendar = getCalendar(dayNum, days)
  document.getElementById('calendar-month-year').innerHTML = monthName[month] + ' ' + year
  document.getElementById('calendar-dates').appendChild(calendar)
}

function getCalendar (dayNum, days) {
  var table = document.createElement('table')
  var tr = document.createElement('tr')
  var td

  // row for the day letters
  for (var i = 0; i <= 6; i++) {
    td = document.createElement('td')
    td.innerHTML = 'SMTWTFS'[i]
    tr.appendChild(td)
  }
  table.appendChild(tr)

  // create 2nd row
  tr = document.createElement('tr')
  for (i = 0; i <= 6; i++) {
    if (i === dayNum) {
      break
    }
    td = document.createElement('td')
    td.innerHTML = ''
    tr.appendChild(td)
  }

  var count = 1;

  for (; i <= 6; i++) {
    td = document.createElement('td')
    td.innerHTML = count
    count++
    tr.appendChild(td)
  }
  table.appendChild(tr)

  // rest of date rows
  for (var r = 3; r <= 6; r++) {
    tr = document.createElement('tr')
    for (var c = 0; c <= 6; c++) {
      if (count > days) {
        table.appendChild(tr)
        return table
      }
      td = document.createElement('td')
      td.innerHTML = count
      count++
      tr.appendChild(td)
    }
    table.appendChild(tr)
  }
}
