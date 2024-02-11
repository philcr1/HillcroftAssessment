## Hillcroft Technical Assessment
This laravel 10 sail project:
- Allows the user to select an XML product file, and enter their email address
- Allows the import of product data (I have provided XML files in the TestData folder with working data, broken data, 1000 products, and 25000 products)
- Sends an email for out of stock notifications to the users provided email
- Displays a list of all imported product data
- Exception handling for broken XML data

I developed this in Visual Studio Code
For the email, I have used the Mailpit plugin, which allows testing of emails.  This can be accessed on http://localhost:8025 when installed

I have also provided various screenshots showing the system working, including emails in Mailpit.

## Setup
- Download the code from GITHUB and open in visual studio code
- Open a new terminal and run ./vendor/bin/sail up
- Navigate to http://localhost/
- Enter an XML product file, email address for out of stock notifications, and click Import Products
