<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

## The instructions/guide on how to run the code is available at the [bottom](#instructionsguide-to-run-the-project) of this README

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned. 

### Instructions

- Fork this repo to your github account
- Complete the tasks given
- Once completed, create a PR to this repository
- Lastly, add some guidance or instruction on how to run your code

### Requirements

You must work on this assignment using:
 - Vue (optional for BE dev) ✅
 - TailwindCSS ✅
 - Laravel (optional for FE dev) ❌
   - I'm using .NET core for the backend with mysql database

### Tasks

1. As guest, I want to be able to register an account ✅  
**You can register your account at [https://supplycart.reeqzan.com/Register](https://supplycart.reeqzan.com/Register)**
2. As guest, I want to be able to login using registered account ✅  
**Once you've registered, you may go to [https://supplycart.reeqzan.com](https://supplycart.reeqzan.com) to login to your account. However, if you're already logged in, it will auto redirect you to the products page**
3. As user, I want to see list of products after login ✅  
**Once you've logged in successfully, you'll be redirected to [https://supplycart.reeqzan.com/Home](https://supplycart.reeqzan.com/Home). The products will be listed there. This page will only be accessible to users that have logged in.**
4. As user, I want to be able to add product to cart ✅  
**In the products page, you may select any size you want, then click 'Add to Cart'. On the top right, second icon from the right, you'll be able to see a cart icon with the count if you've added something into your cart. Clicking the cart icon, will bring up a popup with all the items that you've added to your cart.**
5. As user, I want to be able to place order for added products in cart ✅  
**Once you've satisfied with what you've chosen on the cart popup, click 'Checkout', enter you address and click 'Complete Order'. This will place an order for whatever that is inside your cart.**
6. As user, I want to see my order history ✅  
**The order history is available at [https://supplycart.reeqzan.com/Home/History](https://supplycart.reeqzan.com/Home/History). However, this page will only be accessible by users that have logged in. If you're already logged in, you can go the history page by clicking to top most right icon, then click 'Order History'. This will bring you to the order history page.**
7. As user, I want to be able to logout ✅  
**To logout, click the top most right icon, and click 'Logout'.**

### Bonus Tasks

1. Verify email after registration ✅  
**When registering, please enter a valid email address so that you'll able to receive the verification email. In the email, you'll see a link and a 4 digit code. Navigate to the link and enter the 4 digit code to verify your email. If you did not verify your email, there will be a yellow color bar at the home page saying that your email is not verified. You can also verify your email by clicking on the link inside the yellow color bar in the home page.**
2. User activity log e.g. login, logout, add to cart, place order etc ✅  
**The see your activity log and when does it happened, go to the top right most icon, and click 'My Activity'. This will bring your to [https://supplycart.reeqzan.com/Home/Activity](https://supplycart.reeqzan.com/Home/Activity). In this page, you'll able to see all your activity with the latest one on the top.**
3. Product attributes and filtering e.g brand, category ✅  
**In the home page, there are 3 checkboxes at the top. You may uncheck the category to hide the category from the home page.**
4. Different user can see different price for products ✅  
**When registering, there is a dropdown for user type. You may select 'Basic' or 'Member'. If you select 'Member', you'll see the prices of each product have a discount of 15%.**
5. Add unit tests ❌
6. Deploy app to a server ✅  
**The web application is published to [https://supplycart.reeqzan.com](https://supplycart.reeqzan.com). This is my personal domain, I've added a subdomain for this project.**


P/S: If you think there is a better way for us to asses your technical skills, feel free to suggest. We are constantly looking to improve our interview process.

## Instructions/Guide to Run the Project
### Frontend (Vue.js)
1. cd into the frontend folder using CMD/Terminal
2. run **'npm install'** this is very important to install all the dependencies needed for the frontend to run.
3. For the backend database, you may use two ways;  
   - Use live db from https://api.reeqzan.com  
      To use live db, go to **main.js** file located in **/frontend/src/main.js** and uncomment line 67 and comment out line 68. You code should look like below:  
        ```javascript
        axios.defaults.baseURL = 'https://api.reeqzan.com' // Using live DB
        // axios.defaults.baseURL = 'https://localhost:5001' // Using local DB
        ```
   - Use local db from https://localhost:5001  
      To use live, go to **main.js** file located in **/frontend/src/main.js** and comment out line 68 and uncomment line 67. You code should look like below:  
        ```javascript
        // axios.defaults.baseURL = 'https://api.reeqzan.com' // Using live DB
        axios.defaults.baseURL = 'https://localhost:5001' // Using local DB
        ```
4. If you are using local db, make sure you run the backend before proceed to step 5 ([Run Backend](#backend-net-core))
5. Run the project by typing **'npm run serve'** and your application is accessible at [http://localhost:8080](http://localhost:8080).

### Backend (.NET Core)
1. cd into your backend folder using CMD/Terminal
2. If you frontend is running on a different link besides http://localhost:8080, please change the in **Startup.cs** file located in **/backend/Startup.cs** at line 55. You code should look like blelow:
    ```csharp
    .WithOrigins("http://localhost:8080") // Change this to match your frontend link
    ```
3. To make sure that the backend is connected properly to your mysql database, please change the connection string in **MySqlConnect.cs** located in **/backend/MySQL/MySqlConnect.cs** at line 14. The code should look like below:  

    ```
    private readonly static string ConnectionString = "server=localhost;port=3366;user=USERNAME;password=PASSWORD;database=DATABASENAME";
    ```
   Change '**USERNAME**' to the username of your mysql  
   Change '**PASSWORD**' to the password of your mysql  
   Change '**DATABASENAME**' to the name of the database that you want to connect
4. To make sure that the mailer is working, make sure you modify the codes in **Mailer.cs** located in **/backend/Model/Mailer.cs** at line 14, 17 and 19. The code should look like bwlow:
    ```csharp
    var basicCredential = new NetworkCredential("FROMADDRESS", "FROMPASSWORD");
    ```
    ```csharp
    MailAddress fromAddress = new MailAddress("FROMADDRESS");
    ```
    ```csharp
    smtpClient.Host = "YOURSMTPHOST";
    ```
    Change '**FROMADDRESS**' to the email address that you'll be using to send the email  
    Change '**FROMPASSWORD**' to the password of the email address that you are using  
    Change '**YOURSMTPHOST**' to the smtp host of your email address  
5. Run your backend by typing '**dotnet run**' and your backend will be accessible at [https://localhost:5001](https://localhost:5001)