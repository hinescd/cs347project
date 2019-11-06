/**
 * Javascript file written by Geoffrey Wright and used to display
 * a baseline calander. This will be free for modification and perhaps
 * eventual removal later.
 */

function drawCalendar(date, taShifts) {
  var month = date.getMonth() /* 0-11 */
  var year = date.getFullYear() // year
  var firstDayOfMonth = new Date(year, month, 1)
  var startingDayOfWeek = firstDayOfMonth.getDay() // day of the week the first day of the month is on
  var daysInMonth = new Date(year, month + 1, 0).getDate() // how many days are in the month

  if(taShifts === undefined) {
    // Get a list of shifts for the month if the function wasn't given any. In the future, we should use fetch to get data from the server here
    var classes = ['CS101', 'CS149', 'CS159', 'CS240', 'CS261']
    var taShifts = []
    for(var i = 0; i < daysInMonth; i++) {
      for(var j = 0; j < 3; j++) {
        start = new Date(year, month, i+1, 13+Math.floor(Math.random()*5), 0)
        end = new Date(year, month, i+1, start.getHours() + 2, 0)
        clas = Math.floor(Math.random() * classes.length)
        taShifts.push({class: classes[clas], start: start, end: end})
      }
    }
  }

  /* Calendar construction */
  var calendar = getCalendar(startingDayOfWeek, daysInMonth, taShifts)
  document.getElementById('calendar-month-year').innerHTML = date.toLocaleString('default', {month: 'long'}) + ' ' + year
  document.getElementById('calendar-dates').innerHTML = ''
  document.getElementById('calendar-dates').appendChild(calendar)
}

function getCalendar (startingDayOfWeek, daysInMonth, taShifts) {
  var table = document.createElement('table')
  table.classList.add("calendar")
  var tr = document.createElement('tr')
  var td

  // row for the day letters
  for (var i = 0; i <= 6; i++) {
    td = document.createElement('td')
    td.innerHTML = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Sunday'][i]
    tr.appendChild(td)
  }
  table.appendChild(tr)

  var dayOfMonth = 1
  var makingDays = false  // Used to keep track of whether the month has started yet, since the first day might not be on a Sunday
  tr = document.createElement('tr')

  // Used for getting TA shift times
  var options = {
    hour12: true,
    hour: '2-digit',
    minute: '2-digit'
  }

  // Construct the calendar row by row
  while(dayOfMonth <= daysInMonth) {
    tr = document.createElement('tr')

    // Create 7 cells in the row
    for(var dayOfWeek = 0; dayOfWeek < 7; dayOfWeek++) {
      td = document.createElement('td')

      // If the month has started and hasn't ended
      if((makingDays || dayOfWeek >= startingDayOfWeek) && dayOfMonth <= daysInMonth) {
        makingDays = true

        // Put the day of month in the cell
        td.innerHTML = dayOfMonth

        // And add any shifts for the day
        let shiftsToday = taShifts.filter(shift => shift.start.getDate() == dayOfMonth)
        shiftsToday.forEach(shift => {
          td.innerHTML += `<br><span class="badge badge-primary">${shift.class}: ${shift.start.toLocaleString('default', options)}-${shift.end.toLocaleString('default', options)}</span>`
        })

        // If there are shifts today, populate and show the modal when today's cell is clicked
        if(shiftsToday.length > 0) {
          td.setAttribute('data-toggle', 'modal')
          td.setAttribute('data-target', '#shiftModal')
          td.onclick = e => populateShiftModal(shiftsToday)
        }
        dayOfMonth++
      }
      tr.appendChild(td)
    }
    table.appendChild(tr)
  }
  return table
}

window.onload = function () {
  /* Preamble variables */
  var date = new Date() // today's date

  // In the future, we want PHP to generate an array of shifts here and pass it into drawCalendar
  // so that the shifts for the current month are already loaded in
  drawCalendar(date)
  
  document.querySelector("#prevMonth").onclick = () => {
    date = new Date(date.getFullYear(), date.getMonth()-1)
    drawCalendar(date)
  }
  
  document.querySelector('#nextMonth').onclick = () => {
    date = new Date(date.getFullYear(), date.getMonth()+1)
    drawCalendar(date)
  }
}

function populateShiftModal(shifts) {
  document.querySelector('#shiftModal-date').innerHTML = shifts[0].start.toDateString()
  document.querySelector('#shiftModal-list').innerHTML = ''
  var shiftList = document.createElement('ul')
  shiftList.classList.add('list-group')

  // Used for getting TA shift times
  var options = {
    hour12: true,
    hour: '2-digit',
    minute: '2-digit'
  }

  // List each shift for the day in the modal
  shifts.forEach(shift => {
    shiftList.innerHTML += `<li class="list-group-item">${shift.class}: ${shift.start.toLocaleString('default', options)}-${shift.end.toLocaleString('default', options)}</li>`
  })
  document.querySelector('#shiftModal-list').appendChild(shiftList)
}