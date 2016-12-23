# A2 System Test

---

## Test Strategy

### Testing Goals

The stakeholders are the SDC. Their Test Goals are as follows:

* The server should be responsive under high load.
* The server must follow the minimum requirements for HTTP 1.1.
* The server must work on Linux, Mac and Windows.
* The source code should be released under GPL-2.0.
* The access log should be viewable from a text editor.

### Resources

* 1 Tester
* 1 PC(win7)

### Goals fulfilled by the plan

* The server must follow the minimum requirements for HTTP 1.1
* The server must work on Windows (Only have access to a windows PC).
* The access log should be viewable from a text editor.

---

## Test Plan

### What requirements should be tested

* The Server must follow the minimum requirements for HTTP 1.1
* The Server must work on Windows (Only have access to a windows PC).
* The access log should be viewable from a text editor.

These test are the ones I will be able to test.

### What requirements should NOT be tested

* The server should be responsive under high load.
* The server must work on Linux and Mac.
* The source code should be released under GPL-2.0.

I´m unable to test these, I don´t have the knowledge to test the server under high load.
I have no access to linux or mac computers.
I have no clue how to test if the code is releasable under GPL-2.0.

### How the testing will be done

The testing will be manual testing with testcases built from the use-cases provided.


### Responsibilities

All responsibilities are distributed to Tester #1, as this is a one man crew.

---

## Manual Test Cases

### Test case 1.1

Normal activation of server, server starts.

Server starts and presents that the server has been started, a note is written in the access log.

__Input:__

* An available port
* The adress to the folder

__Output:__

* The server has started
* A note is written in the access log

### Test case 1.2

Atempt to start server with non-available port.

Server should not start and an error message about port already taken should appear.

__Input__

* A non-available port
* The adress to the folder

__Output__

* The server should not start
* Recives error message "Socket XX was taken"

### Test case 1.3

Atempt to start server with the resource container being restricted.

Server should not start and an error message about no access to the folder should appear.

__Input__

* An available port
* The adress to an restricted folder

__Output__

* The server should not start
* Recives error message "“No access to folder XX"

### Test case 1.4

Normal activation without the access log.

Server should not start and recive error message.

__Input__

* An available port
* The adress to the folder
* Remove log.txt

__Output__

* The server should not start
* An error message "Cannot write to server log file log.txt" should appear

### Test case 2.1

Stop the server.

The server should not be active.

__Input__

* Start server
* Stop the server

__Output__

* The server should stop
* A note that the server have been stopped should be in the access log

### Test Case 3.1

Access the shared resourceson the server from an browser.

The system delivers the shared resources to the browser and a note is written in the access log.

__Input__

* Start server
* Go to localhost and view shared resources

__Output__

* Resourcesis shown
* A success note is written in the Access log

### Test Case 3.2

Access the shared resources thats not there.

Should recive "resource not found" error.

__Input__

* Start server
* Go to localhost and view shared resources that are not there

__Output__

* "404 Not found error" is shown
* A failure note is written in the access log

### Test Case 3.3

Access resources that are outside the shared container.

Should recive "resource is forbidden" error message.

__Input__

* Start server
* Go to localhost and atempt to view resources outside the shared container

__Output__

* "403 Forbidden" error is shown
* A failure note is written in the access log

### Test Case 3.4

Atempt to access resource with invalid or malformed request.

Should recive that request could not be handled.

__Input__

* Start server
* Go to localhost and atempt to view resources with invalid requests

__Output__

* "400 Bad request" error is shown
* A failure note is written in the access log

### Test Case 3.5

Atempt to access resource and server encounters an error.

Should recive message about internall error.

__Input__

* Start server
* Go to localhost and atempt to view resources with an introdused error to server

__Output__

* Internal error message should be shown
* A failure note is written in the access log

---

## Test Results

### Test Case 1.1 - __Fail__

Server is started and can be accessed, but there is no note in the log file.

### Test Case 1.2 - __Pass__

Recived message "Port is taken" and server did not start.

### Test Case 1.3 - __Fail__

The server still started even though the resource folder war restricted, recived a "404 not found" error message.

### Test Case 1.4 - __Fail__

The server still started and no message about the log appeared, the log doesn´t appear to be used.

### Test Case 2.1 - __Fail__

Server stops but no notes are written in the log file.

### Test Case 3.1 - __Fail__

The resources are shown but there is no notes written in the access log.

### Test Case 3.2 - __Fail__

The "404 error" is shown but there is no notes written in the access log.

### Test Case 3.3 - __Unable__

I dont know how to atempt to access resources outside the shared container.

### Test Case 3.4 - __Unable__

I don´t know how to test this.

### Test Case 3.5 - __Unable__

I don´t know how to test this.