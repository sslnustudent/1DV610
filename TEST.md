# A2 Test Plan

---

## Test Strategy

### Testing Goals

The stakeholders are the SDC. Their Test Goals are as follows:

* The Server should be responsive under high load.
* The Server must follow the minimum requirements for HTTP 1.1
* The Server must work on Linux, Mac and Windows.
* The Source code should be released under GPL-2.0.
* The access log should be viewable from a text editor.

### Resources

* 1 Tester
* 1 PC(win7)

### Goals fulfilled by plan

* The Server must follow the minimum requirements for HTTP 1.1
* The Server must work on Windows (Only have access to a windows PC).
* The access log should be viewable from a text editor.

---

## Test Plan

### What requirements should be tested

* The Server must follow the minimum requirements for HTTP 1.1
* The Server must work on Windows (Only have access to a windows PC).
* The access log should be viewable from a text editor.

These test are the ones I will be able to test.

### What requirements should NOT be tested

* The Server should be responsive under high load.
* The Server must work on Linux and Mac.
* The Source code should be released under GPL-2.0.

I´m unable to test these, I have neither knowledge nor resourses to test the server under high load.
I have no access to linux or mac computers.
I have no qlue how to test if the code is releasable under GPL-2.0.

### How the testing will be done

The Testing will be manual testing with testcases built from the usecases provided.


### Responsibilities

All responsibilities are distributed to Tester #1, as this is a one man crew.

---

## Manual Test Cases

### Test case 1.1

Normal activation of server, server starts.

Server starts on given port and presents that the server has been started, a note is written in the access log.

__Input:__

* An available port
* The adress to the folder

__Output:__

* The server has started
* A note is written in the access log

### Test case 1.2

Atempt to start server with non-available port.

Server should not start and an error message about port already taken.

__Input__

* An non-available port
* The adress to the folder

__Output__

* The server should not start
* Recives error message "Socket XX was taken"

### Test case 1.3

Atempt to start server with a the resource container that is restricted.

Server should not start and an error message about no access to the folder

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



---

## Test Results
