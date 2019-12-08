# WebDev Assignment 
Completed by Eoghan Byrne (C17315336) and Callam Leakey (C17475466) -24/11/2019

### Overview
These set of web pages are designed to allow users to access a database of books in a library system, access the information about these books e.g year of release , author etc.
Once a user has created an account they will have access to this database and can lo in and view at any time.The user will also have the ability to reserve a book that they might want from the library.
A special admin account is also available that allows the user to make changes to the library database.

# Files

## Login/Logout/Register

 - Login
 -The login web page allows users who have previously registered an account to easily log on to the library system by entering in their associated credentials.This page also has the option to bring you to the register page where they can set up a new account or to the forgot password option which allows users who've forgotten their password to easily reset and regain access to the site.
 
 - Logout
 -The logout page is provided to users who are already logged in and wish to exit the site or change users.This webpage is accessed by clicking the profile icon in the top right corner and then pressing the logout option . A user who wishes to log out and clicks the option will first be presented with a conformation that asks are they sure they wish to log out to avoided unwanted accidents.Once a user is logged out they will be instantly brought to the login page.  

- Register
 -- The register web page allows a user to set up an account on the site , here they enter details such as their first name , last name , email and desired password.Once the user fills in the fields and registers the account their details are stored in the SQL database "users".This allows hem to log on using these credentials in the future.
 


## CRUD Functionality 

CRUD is implemented when an admin user has the ability to create new user , read information on existing users, make changes to existing users , and remove existing users completely from the library system database.Only the Admin has access to these features to protect from intentional or accidental changes to information that may be unwanted.

## Search 

The search tab , calls on search.php and backend-search.php at the same time and performs a live search , the text field detects that something has been typed and tries to find terms similar and provide an output to the user. 

## Account Setting 
Here the user has the ability to make changes to their own personal details such as name and email. The user also has the option to upload as picture file as their profile picture.This is also where file uploading was implemented.


## Authentication

Throughout the web pages we have implemented validation techniques to make sure the user can only enter relevant and correct information.


## Injection 
Throughout our code the use of predefined sql statements means that we have taken steps to avoid SQL injection .
