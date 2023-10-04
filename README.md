# akaunting
Akaunting Project modified as Client request


Client Request:
1. Download and run Akaunting app locally
2. Write a small module inside that. Create two API inside that module. Those are:
2.1 Create user 
2.2. Create Invoice and Bill between two user


**I have created below Modules and Requests to API to make actions**

1. http://localhost/akaunting1/public/api/v1/userCreate  => POST Method
   - This method create user
   - POST BODY: 
   - { "name":"test", "email":"test@yopmail.com", "password":123456 }


3. http://localhost/akaunting1/public/api/v1/getUsers == GET Method
   - This Method Return all Users

4. http://localhost/akaunting1/public/api/v1/userInvoiceCreate  => POST MEthod
   - This Method Create Invoice for User id provided in Post
   - POST BODY: 
   - { "userId":1, "amount":50 }

4. http://localhost/akaunting1/public/api/v1/getUserInvoiceCreate/{UserId} => Get Method
   - This method return Created Invoice data for provided User id
