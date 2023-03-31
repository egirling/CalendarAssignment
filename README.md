# CSE330

Elizabeth Girling 490674

Gautami Kankipati 491320

Link: http://ec2-54-153-91-49.us-west-1.compute.amazonaws.com/~egirling/calendar/calendar.html 

Things to know about our calendar:
  When you edit an event that doesn’t exist, it creates a new event with the corresponding input values. 
  One of the users we created has a username of user1 and a password of user1 that you can log in with. 
  You may also create your own users.
  All the functions of the calendar are below it, if for some reason it looks like a change has not updated on the calendar (event doesn't appear after
  creation) you may click the update button located right underneath the calendar. 


Creative Portion: 

  Tagging events according to if it’s a birthday, exam, due date, or meeting, or no tag (default) 
  Tagging the event will highlight the event in a specific color: 
      For a birthday, it’s pink 
      For an exam, it’s aqua 
      For a meeting, it’s orange 
      For a due date, it’s yellow
      For default, it won’t be highlighted 
  Group sharing events 
      Can only share with one person at a time 
      Whenever you try to share an event that doesn’t exist, it creates a new event. 
  Sharing calendar with another user
      If you want to share your calendar with another user, you can type in the username to share it with them. 
      If you want to view another user’s calendar, then you can type in their username and click to view their events. You’ll only be able to see their           events if they shared their calendar with you already. 
      After viewing the calendar that someone shared with you, to see your own calendar view (the original view), the user can log out and log back in. 


# Grading
-2pt For modifying events: instead of using the UPDATE query, a combination of DELETE and INSERT is used. This is not the recommended method of updating an entry in the database, and is the cause of new events being created when modifying a nonexistent event.

-1pt As mentioned in the readme, there are times where update button must be pressed to retrieve the correct information about the calendar.

-1pt Not all content is escaped on output. For instance, try adding an event with the event name: &lt;hr&gt;

-2pt W3C validator reveals two errors, both regarding the absence of alt attribute for img tags.

-2pt The layout of the website makes it difficult for users to use the calendar intuitively. Deleting / modifying / sharing events require users to type in all information about existing events in order to execute desired functions. 
