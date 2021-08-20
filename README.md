# Cinema Guide Application

    ## Introduction
    This documentation describes the important notes that the developer has experienced while implementing the application.


    ## System Architecture

        ### Application Data Model

        The diagram at below path represents the data model that has been considered for the application

        ~\resources\images\diagram.png
        
        ### Application Workflows overview
           1.	The Cinema guide application allows users to manage cinemas, movies, and movies sessions at the particular cinema once they are logged into the system. 
           2.	Logged in users can view,  add, edit and delete cinemas.
           3.	Logged in users can view, add, edit and delete movies.
           4.	Logged-in users can also add movies sessions to the cinema and update and delete them.
           5.   To use the application and APIs, a user account will have to be registered by calling the “/api/register” endpoint. This will generate an API Access Token which can be used to access the APIs. Also, you would be able to login into the web portal by using your email id and password used while registering

    ## Troubleshooting
    Below are some issues that I have experienced during the application development and details about the solution that I have implemented in order to address the issue
        1.	While working with Sanctum Authentication faced some issues that were resolved by integrating the Passport authentication for REST API authentications.

    ## API Documentation 
    The API documentation can be found at the link mentioned below – [LINK]
